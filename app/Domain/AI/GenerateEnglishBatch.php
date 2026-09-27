<?php

namespace App\Domain\AI;

use App\Models\AiGenerationJob;
use App\Models\Question;
use App\Models\QuestionSource;
use App\Models\QuestionVersion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RuntimeException;

class GenerateEnglishBatch
{
    public function execute(AiGenerationJob $job, AiQuestionGeneratorInterface $provider): bool
    {
        $actor = User::findOrFail($job->requested_by);
        if ($actor->status->value !== 'ACTIVE' || ! $actor->can('ai.generate') || $actor->center_id !== $job->center_id) {
            throw new RuntimeException('Generation access is no longer active.');
        }
        $scope = app(AuthoringScope::class);
        $documents = $scope->documents($actor)->whereIn('id', $job->documents()->pluck('source_documents.id'))->with('chunks')->get();
        if ($documents->isEmpty() || $documents->count() !== $job->documents()->count() || $documents->contains(fn ($d) => $d->status !== 'READY')) {
            throw new RuntimeException('Selected sources are not ready or no longer accessible.');
        }
        $progress = $job->progress_json ?? ['done' => [], 'attempts' => [], 'invalid_count' => 0];
        $slots = app(GenerationBlueprint::class)->slots($job->request_json);
        $pending = array_values(array_filter($slots, fn ($s) => ! isset($progress['done'][$s['slot']])));
        if (! $pending) {
            return true;
        }
        $first = $pending[0];
        $exactMode = ($job->request_json['source_mode'] ?? 'generated') === 'extract_exact';
        $batch = $exactMode
            ? array_slice($pending, 0, config('english-ai.batch_size'))
            : array_slice(array_values(array_filter($pending, fn ($s) => $s['type'] === $first['type'] && $s['difficulty'] === $first['difficulty'] && $s['category'] === $first['category'])), 0, config('english-ai.batch_size'));
        if ($exactMode) {
            foreach ($batch as &$slot) {
                $slot['allow_any'] = true;
            }
            unset($slot);
        }
        $sourceOffset = (int) ($progress['source_offset'] ?? 0);
        $sourceScope = (string) ($job->request_json['source_scope'] ?? 'all');
        $sourceChunks = $documents->flatMap->chunks
            ->filter(fn ($c) => ! (bool) (($c->metadata_json ?? [])['superseded'] ?? false))
            ->filter(fn ($c) => empty($job->request_json['source_chunk_ids']) || in_array($c->id, $job->request_json['source_chunk_ids']))
            ->when($exactMode && $sourceScope !== 'all', fn ($items) => $items->filter(function ($chunk) use ($sourceScope): bool {
                $activity = strtoupper((string) (($chunk->metadata_json ?? [])['activity_type'] ?? 'GENERAL'));

                return match ($sourceScope) {
                    'vocabulary_grammar' => in_array($activity, ['VOCABULARY_GRAMMAR', 'VOCABULARY', 'GRAMMAR'], true),
                    'reading' => $activity === 'READING',
                    'writing' => $activity === 'WRITING',
                    default => true,
                };
            }))
            ->when(! $exactMode, fn ($items) => $items->sortByDesc(fn ($c) => ($c->metadata_json['section_type'] ?? '') === $first['category']))
            ->when($exactMode, fn ($items) => $items->sortBy(fn ($chunk) => sprintf('%010d-%010d-%010d-%010d', (int) $chunk->source_document_id, (int) ($chunk->page_number ?? PHP_INT_MAX), (int) ($chunk->chunk_index ?? $chunk->id), (int) $chunk->id)));
        $sources = [];
        $nextSourceOffset = $sourceOffset + 1;
        if ($exactMode) {
            // Exact extraction must be deterministic: give the provider one
            // contiguous source section at a time, starting at the first
            // section in document order. Sending a large mixed window allowed
            // the provider to skip Vocabulary/Grammar and select Reading.
            $ordered = $sourceChunks->values();
            $cursor = min($sourceOffset, max(0, $ordered->count() - 1));
            $start = null;
            while ($cursor < $ordered->count()) {
                $activity = strtoupper((string) (($ordered[$cursor]->metadata_json ?? [])['activity_type'] ?? 'GENERAL'));
                if ($activity !== 'GENERAL') {
                    $start = $cursor;
                    break;
                }
                $cursor++;
            }
            if ($start !== null) {
                $firstActivity = strtoupper((string) (($ordered[$start]->metadata_json ?? [])['activity_type'] ?? 'GENERAL'));
                $firstGroup = (string) (($ordered[$start]->metadata_json ?? [])['group_key'] ?? '');
                $section = [];
                for ($i = $start; $i < $ordered->count() && count($section) < 24; $i++) {
                    $metadata = (array) ($ordered[$i]->metadata_json ?? []);
                    if (strtoupper((string) ($metadata['activity_type'] ?? 'GENERAL')) !== $firstActivity || (string) ($metadata['group_key'] ?? '') !== $firstGroup) {
                        break;
                    }
                    $section[] = $ordered[$i];
                }
                $sources = collect($section)->map(fn ($c) => ['id' => $c->id, 'document_id' => $c->source_document_id, 'page_number' => $c->page_number, 'heading' => $c->heading, 'content' => $c->content, 'metadata' => $c->metadata_json])->values()->all();
                $nextSourceOffset = $start + count($section);
            }
        } else {
            $sources = $sourceChunks->take(8)->map(fn ($c) => ['id' => $c->id, 'document_id' => $c->source_document_id, 'page_number' => $c->page_number, 'heading' => $c->heading, 'content' => $c->content, 'metadata' => $c->metadata_json])->values()->all();
        }
        if (! $sources) {
            throw new RuntimeException('insufficient_context: no usable source sections.');
        }
        $existing = QuestionVersion::whereHas('question', fn ($q) => $q->where('center_id', $job->center_id)->where('course_version_id', $job->request_json['course_version_id']))->latest('id')->limit(100)->get()->pluck('content_json.prompt')->filter()->values()->all();
        $categoryHint = $exactMode ? match ($sourceScope) {
            'vocabulary_grammar' => 'vocabulary',
            'writing' => 'writing',
            default => 'reading',
        } : $first['category'];
        $request = array_merge($job->request_json, ['type' => $first['type'], 'difficulty' => $first['difficulty'], 'english_category' => $sourceScope === 'all' ? null : $categoryHint, 'number_of_questions' => count($batch), 'avoid_prompts' => $existing]);
        if ($exactMode) {
            // The exact extractor must follow the PDF, not the blueprint
            // fields submitted by the form. Leaving category_counts=reading or
            // difficulty_counts=EASY here makes the provider reject a valid
            // Vocabulary/Grammar section as insufficient context.
            unset($request['type'], $request['difficulty'], $request['english_category'], $request['type_counts'], $request['difficulty_counts'], $request['category_counts'], $request['grade_level'], $request['cefr_level']);
            $request['source_mode'] = 'extract_exact';
            $request['source_scope'] = $sourceScope;
        }
        $job->update(['status' => 'PROCESSING', 'progress_json' => array_merge($progress, ['phase' => 'GENERATING'])]);
        $result = $provider->generate($request, $sources);
        if (! is_array($result['questions'] ?? null) || count($result['questions']) > count($batch)) {
            throw new RuntimeException('AI returned an invalid batch size.');
        }
        $validator = app(EnglishQuestionValidator::class);
        $outputs = [];
        $invalid = 0;
        $validationErrors = [];
        if (($result['insufficient_context'] ?? false) === true) {
            $validationErrors[] = 'AI provider reported insufficient context for the selected source section.';
        } elseif (empty($result['questions'])) {
            $validationErrors[] = 'AI provider returned no questions for the selected source section.';
        }
        foreach ($result['questions'] as $outputIndex => $output) {
            try {
                // Exact batches mark each slot allow_any=true. Use that slot
                // here; validating against $first would re-apply the old
                // MEDIUM/category constraints and reject valid PDF questions.
                $validationSlot = $batch[$outputIndex] ?? $first;
                $output = $validator->validate($output, $validationSlot, $sources);
                if ($validator->duplicate($output['content']['prompt'], array_merge($existing, array_column(array_column($outputs, 'content'), 'prompt')))) {
                    $invalid++;

                    continue;
                }
                // Compare against the full scoped bank in bounded database chunks.
                $duplicate = false;
                QuestionVersion::whereHas('question', fn ($q) => $q->where('center_id', $job->center_id)->where('course_version_id', $job->request_json['course_version_id']))->select('id', 'content_json')->chunkById(200, function ($versions) use (&$duplicate, $validator, $output) {
                    $duplicate = $validator->duplicate($output['content']['prompt'], $versions->pluck('content_json.prompt')->filter()->all());

                    return ! $duplicate;
                });
                if ($duplicate) {
                    $invalid++;

                    continue;
                }
                // Keep the provider slot index; compacting valid outputs would
                // assign a valid later question to the wrong slot after a reject.
                $outputs[$outputIndex] = $output;
            } catch (ValidationException $e) {
                $invalid++;
                $validationErrors[] = (string) (collect($e->errors())->flatten()->first() ?: 'Question failed validation.');
            }
        }

        return DB::transaction(function () use ($job, $progress, $batch, $outputs, $invalid, $validationErrors, $result, $validator, $slots, $exactMode, $sourceOffset, $nextSourceOffset) {
            $locked = AiGenerationJob::withoutGlobalScopes()->lockForUpdate()->findOrFail($job->id);
            if ($locked->status === 'CANCELLED') {
                return true;
            }
            $progress['phase'] = 'VALIDATING';
            if ($exactMode) {
                // Do not skip a section when every output in this batch was
                // rejected. The previous behavior advanced to Reading after
                // a failed Vocabulary/Grammar batch, producing Reading-only jobs.
                $progress['source_offset'] = count($outputs) >= count($batch) ? $nextSourceOffset : $sourceOffset;
            }
            $progress['invalid_count'] = ($progress['invalid_count'] ?? 0) + $invalid;
            if ($validationErrors) {
                $progress['validation_errors'] = array_slice(array_values(array_unique(array_merge($progress['validation_errors'] ?? [], $validationErrors))), -10);
            }
            foreach ($batch as $index => $slot) {
                $key = $slot['slot'];
                $progress['attempts'][$key] = ($progress['attempts'][$key] ?? 0) + 1;
                if (! array_key_exists($index, $outputs)) {
                    continue;
                }
                $output = $outputs[$index];
                $attributes = ['center_id' => $job->center_id, 'course_version_id' => $job->request_json['course_version_id'], 'type' => $output['type'], 'skill' => $output['skill'], 'difficulty' => $output['difficulty'], 'english_category' => $output['english_category'], 'concept' => $output['concept'], 'status' => 'IN_REVIEW', 'created_by' => $job->requested_by, 'ai_generation_job_id' => $job->id, 'content_hash' => hash('sha256', $validator->normalize($output['content']['prompt']))];
                if ($replace = $job->request_json['replace_question_id'] ?? null) {
                    $question = Question::withoutGlobalScopes()->where('center_id', $job->center_id)->lockForUpdate()->findOrFail($replace);
                    $question->update($attributes);
                } else {
                    $question = Question::create($attributes);
                }
                $sourceGroup = (array) ($output['source_group'] ?? []);
                $settings = array_merge($output['settings'], [
                    'generation_job_id' => $job->id, 'english_category' => $output['english_category'],
                    'concept' => $output['concept'], 'difficulty' => $output['difficulty'],
                    'prompt_version' => $job->prompt_version, 'model' => $job->model,
                    'source_group_key' => (string) ($sourceGroup['groupKey'] ?? 'general'),
                    'source_section_title' => (string) ($sourceGroup['sectionTitle'] ?? ''),
                    'source_activity_type' => (string) ($sourceGroup['activityType'] ?? 'GENERAL'),
                    'source_passage_key' => $sourceGroup['passageKey'] ?? null,
                    'source_passage_text' => (string) ($sourceGroup['passageText'] ?? ''),
                    'source_question_number' => $sourceGroup['questionNumber'] ?? null,
                    'source_preserve_exact' => (bool) ($sourceGroup['preserveSource'] ?? false),
                ]);
                $version = $question->versions()->create(['version_number' => ($question->versions()->max('version_number') ?? 0) + 1, 'content_json' => $output['content'], 'answer_key_json' => $output['answerKey'], 'settings_json' => $settings, 'explanation' => $output['explanation'], 'created_by' => $job->requested_by]);
                foreach ($output['sources'] as $source) {
                    QuestionSource::create(['question_version_id' => $version->id, 'document_chunk_id' => $source['chunkId'], 'page_number' => $source['pageNumber'], 'source_excerpt' => $source['sourceExcerpt']]);
                }
                $progress['done'][$key] = $question->id;
            }
            $complete = count($progress['done']) === count($slots);
            $exhausted = collect($batch)->contains(fn ($s) => ! isset($progress['done'][$s['slot']]) && $progress['attempts'][$s['slot']] >= config('english-ai.max_attempts'));
            $diagnostic = $progress['validation_errors'][0] ?? null;
            $locked->update(['generated_count' => count($progress['done']), 'progress_json' => $progress, 'status' => $complete ? 'COMPLETED' : ($exhausted ? 'FAILED' : 'PROCESSING'), 'error_message' => $exhausted ? 'insufficient_context: some slots could not be filled with valid, distinct questions.'.($diagnostic ? ' Validation: '.$diagnostic : ' Review available drafts or retry remaining slots.') : null, 'completed_at' => ($complete || $exhausted) ? now() : null, 'input_tokens' => ($locked->input_tokens ?? 0) + ($result['usage']['input_tokens'] ?? 0), 'output_tokens' => ($locked->output_tokens ?? 0) + ($result['usage']['output_tokens'] ?? 0)]);

            return $complete || $exhausted;
        });
    }
}
