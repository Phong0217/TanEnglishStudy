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
        $batch = array_slice(array_values(array_filter($pending, fn ($s) => $s['type'] === $first['type'] && $s['difficulty'] === $first['difficulty'] && $s['category'] === $first['category'])), 0, config('english-ai.batch_size'));
        $sources = $documents->flatMap->chunks->filter(fn ($c) => empty($job->request_json['source_chunk_ids']) || in_array($c->id, $job->request_json['source_chunk_ids']))->sortByDesc(fn ($c) => ($c->metadata_json['section_type'] ?? '') === $first['category'])
            ->take(8)->map(fn ($c) => ['id' => $c->id, 'document_id' => $c->source_document_id, 'page_number' => $c->page_number, 'heading' => $c->heading, 'content' => $c->content, 'metadata' => $c->metadata_json])->values()->all();
        if (! $sources) {
            throw new RuntimeException('insufficient_context: no usable source sections.');
        }
        $existing = QuestionVersion::whereHas('question', fn ($q) => $q->where('center_id', $job->center_id)->where('course_version_id', $job->request_json['course_version_id']))->latest('id')->limit(100)->get()->pluck('content_json.prompt')->filter()->values()->all();
        $request = array_merge($job->request_json, ['type' => $first['type'], 'difficulty' => $first['difficulty'], 'english_category' => $first['category'], 'number_of_questions' => count($batch), 'avoid_prompts' => $existing]);
        $job->update(['status' => 'PROCESSING', 'progress_json' => array_merge($progress, ['phase' => 'GENERATING'])]);
        $result = $provider->generate($request, $sources);
        if (! is_array($result['questions'] ?? null) || count($result['questions']) > count($batch)) {
            throw new RuntimeException('AI returned an invalid batch size.');
        }
        $validator = app(EnglishQuestionValidator::class);
        $outputs = [];
        $invalid = 0;
        foreach ($result['questions'] as $output) {
            try {
                $output = $validator->validate($output, $first, $sources);
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
                $outputs[] = $output;
            } catch (ValidationException $e) {
                $invalid++;
            }
        }

        return DB::transaction(function () use ($job, $progress, $batch, $outputs, $invalid, $result, $validator, $slots) {
            $locked = AiGenerationJob::withoutGlobalScopes()->lockForUpdate()->findOrFail($job->id);
            if ($locked->status === 'CANCELLED') {
                return true;
            }
            $progress['phase'] = 'VALIDATING';
            $progress['invalid_count'] = ($progress['invalid_count'] ?? 0) + $invalid;
            foreach ($batch as $index => $slot) {
                $key = $slot['slot'];
                $progress['attempts'][$key] = ($progress['attempts'][$key] ?? 0) + 1;
                if (! isset($outputs[$index])) {
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
                $settings = array_merge($output['settings'], ['generation_job_id' => $job->id, 'english_category' => $output['english_category'], 'concept' => $output['concept'], 'difficulty' => $output['difficulty'], 'prompt_version' => $job->prompt_version, 'model' => $job->model]);
                $version = $question->versions()->create(['version_number' => ($question->versions()->max('version_number') ?? 0) + 1, 'content_json' => $output['content'], 'answer_key_json' => $output['answerKey'], 'settings_json' => $settings, 'explanation' => $output['explanation'], 'created_by' => $job->requested_by]);
                foreach ($output['sources'] as $source) {
                    QuestionSource::create(['question_version_id' => $version->id, 'document_chunk_id' => $source['chunkId'], 'page_number' => $source['pageNumber'], 'source_excerpt' => $source['sourceExcerpt']]);
                }
                $progress['done'][$key] = $question->id;
            }
            $complete = count($progress['done']) === count($slots);
            $exhausted = collect($batch)->contains(fn ($s) => ! isset($progress['done'][$s['slot']]) && $progress['attempts'][$s['slot']] >= config('english-ai.max_attempts'));
            $locked->update(['generated_count' => count($progress['done']), 'progress_json' => $progress, 'status' => $complete ? 'COMPLETED' : ($exhausted ? 'FAILED' : 'PROCESSING'), 'error_message' => $exhausted ? 'insufficient_context: some slots could not be filled with valid, distinct questions. Review available drafts or retry remaining slots.' : null, 'completed_at' => ($complete || $exhausted) ? now() : null, 'input_tokens' => ($locked->input_tokens ?? 0) + ($result['usage']['input_tokens'] ?? 0), 'output_tokens' => ($locked->output_tokens ?? 0) + ($result['usage']['output_tokens'] ?? 0)]);

            return $complete || $exhausted;
        });
    }
}
