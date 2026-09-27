<?php

namespace App\Domain\Learning;

use App\Domain\AI\AuthoringScope;
use App\Enums\QuestionType;
use App\Models\Lesson;
use App\Models\LessonBlock;
use App\Models\LessonVersion;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/** Copies approved QuestionVersions into a Lesson draft without duplicating the source question. */
class ImportAiQuestionsToLesson
{
    public function execute(User $actor, Lesson $lesson, array $questionIds): Collection
    {
        if (! $actor->can('update', $lesson)) {
            abort(403);
        }

        return DB::transaction(function () use ($actor, $lesson, $questionIds): Collection {
            $lockedLesson = Lesson::query()->lockForUpdate()->findOrFail($lesson->id);
            $scope = app(AuthoringScope::class);
            $allowedQuestionIds = $scope->questions($actor)->whereIn('id', $questionIds)->pluck('id')->map(fn ($id) => (int) $id)->all();
            if (count($allowedQuestionIds) !== count($questionIds)) {
                throw ValidationException::withMessages(['question_ids' => 'Một hoặc nhiều câu hỏi không thuộc phạm vi của bạn.']);
            }
            $questions = Question::query()->whereIn('id', $allowedQuestionIds)->with('versions')->lockForUpdate()->get();
            if ($questions->where('status', '!=', 'APPROVED')->isNotEmpty()) {
                throw ValidationException::withMessages(['question_ids' => 'Chỉ câu hỏi đã được duyệt mới có thể đưa vào Lesson.']);
            }

            $draft = $this->draftVersion($lockedLesson, $actor);
            $existingVersionIds = $draft->blocks()->whereNotNull('question_version_id')->pluck('question_version_id')->map(fn ($id) => (int) $id)->all();
            $existingImportedGroups = $draft->blocks()
                ->where('block_type', 'reading_comprehension')
                ->get()
                ->map(fn (LessonBlock $block) => (string) (($block->settings_json ?? [])['source_ai_group_key'] ?? ''))
                ->filter()
                ->all();
            $occupied = LessonBlock::withTrashed()->where('lesson_id', $lockedLesson->id)->pluck('position')->map(fn ($position) => (int) $position)->all();
            $position = $this->nextPosition($draft, $occupied);
            $created = collect();
            $createdOrder = [];

            // Question queries do not preserve selection order. In exact
            // extraction mode the source number is the canonical PDF order;
            // submitted selection order is the deterministic fallback.
            $requestedOrder = collect($questionIds)->mapWithKeys(fn ($id, $index) => [(int) $id => $index]);
            $orderedQuestions = $questions->sortBy(function (Question $question) use ($requestedOrder): string {
                $version = $question->versions->first();
                $number = $this->sourceQuestionNumber((array) ($version?->settings_json ?? []));

                return sprintf('%010d-%010d', $number ?? PHP_INT_MAX, $requestedOrder->get((int) $question->id, PHP_INT_MAX));
            })->values();

            $readingGroups = [];
            $individualQuestions = [];
            foreach ($orderedQuestions as $orderedIndex => $question) {
                $version = $question->versions->first();
                if (! $version) {
                    throw ValidationException::withMessages(['question_ids' => "Question {$question->id} has no version to import."]);
                }
                $sourceSettings = (array) ($version->settings_json ?? []);
                if ($this->isReadingQuestion($question, $sourceSettings)) {
                    $group = $this->readingGroup($question, $sourceSettings);
                    $readingGroups[$group['key']]['meta'] ??= $group;
                    $readingGroups[$group['key']]['questions'][] = [$question, $version, $sourceSettings, $orderedIndex];
                    $readingGroups[$group['key']]['first_order'] = min($readingGroups[$group['key']]['first_order'] ?? PHP_INT_MAX, $orderedIndex);
                } else {
                    $individualQuestions[] = [$question, $version, $sourceSettings, $orderedIndex];
                }
            }

            foreach ($individualQuestions as [$question, $version, $sourceSettings, $orderedIndex]) {
                if (in_array((int) $version->id, $existingVersionIds, true)) {
                    // Re-importing an already approved AI question should also
                    // repair legacy blocks that stored A/B/C/D in the prompt.
                    $existingBlock = $draft->blocks()->where('question_version_id', $version->id)->first();
                    if ($existingBlock) {
                        $cleanContent = $this->removeQuestionNumber((array) $existingBlock->content_json);
                        if ($cleanContent !== ($existingBlock->content_json ?? [])) {
                            $existingBlock->update(['content_json' => $cleanContent]);
                        }
                    }
                    continue;
                }

                $type = $question->type instanceof QuestionType ? $question->type->value : (string) $question->type;
                $sourceActivity = strtoupper((string) ($sourceSettings['source_activity_type'] ?? ''));
                $sourceGroup = trim((string) ($sourceSettings['source_group_key'] ?? ''));
                $passageKey = trim((string) ($sourceSettings['source_passage_key'] ?? ''));
                $groupSeed = $sourceGroup !== '' ? $sourceGroup : ($question->english_category ?: 'general');
                if ($passageKey !== '') {
                    $groupSeed .= '|'.$passageKey;
                }
                $activityGroupId = 'ai:'.((int) ($question->ai_generation_job_id ?? 0)).':'.substr(hash('sha1', $groupSeed), 0, 16);
                $sourceSkill = match ($sourceActivity) {
                    'READING' => 'READING', 'LISTENING' => 'LISTENING', 'WRITING' => 'WRITING', 'SPEAKING' => 'SPEAKING',
                    'VOCABULARY' => 'VOCABULARY', 'GRAMMAR' => 'GRAMMAR', default => 'MIXED',
                };
                $settings = array_merge($sourceSettings, [
                    'skill' => $sourceSkill,
                    'english_category' => $question->english_category,
                    'difficulty' => $question->difficulty,
                    'source_question_id' => $question->id,
                    'source_question_version_id' => $version->id,
                    'ai_generation_job_id' => $question->ai_generation_job_id,
                    'imported_from_ai' => true,
                    'activity_group_id' => $activityGroupId,
                    'activity_group_type' => $sourceActivity !== '' ? $sourceActivity : 'PRACTICE',
                    'activity_group_title' => (string) ($sourceSettings['source_section_title'] ?? ucfirst((string) ($question->english_category ?: 'Practice'))),
                    'source_question_number' => $sourceSettings['source_question_number'] ?? null,
                    'source_preserve_exact' => (bool) ($sourceSettings['source_preserve_exact'] ?? false),
                ]);
                if ($version->explanation) {
                    $settings['explanation'] = $version->explanation;
                }

                $block = $draft->blocks()->create([
                    'lesson_id' => $lockedLesson->id,
                    'question_version_id' => $version->id,
                    'block_type' => $type,
                    'content_json' => $this->removeQuestionNumber((array) $version->content_json),
                    'answer_key_json' => $version->answer_key_json,
                    'settings_json' => $settings,
                    'points' => 1,
                    'position' => $position++,
                    'required' => false,
                    'grading_mode' => $this->gradingMode($type),
                ]);
                $created->push($block);
                $createdOrder[$block->id] = $orderedIndex;
                $existingVersionIds[] = (int) $version->id;
            }

            // A reading passage and its questions are one activity. Keep them
            // in one composite block so assignment snapshots can split children
            // for grading without losing their shared passage context.
            foreach ($readingGroups as $group) {
                $meta = $group['meta'];
                if (in_array($meta['key'], $existingImportedGroups, true)) {
                    // Repair legacy grouped reading blocks without duplicating
                    // the activity or changing its answer keys.
                    $existingGroupBlock = $draft->blocks()
                        ->where('block_type', 'reading_comprehension')
                        ->get()
                        ->first(fn (LessonBlock $block): bool => (string) (($block->settings_json ?? [])['source_ai_group_key'] ?? '') === $meta['key']);
                    if ($existingGroupBlock) {
                        $cleanContent = $this->normalizeNestedQuestionContent((array) $existingGroupBlock->content_json);
                        if ($cleanContent !== ($existingGroupBlock->content_json ?? [])) {
                            $existingGroupBlock->update(['content_json' => $cleanContent]);
                        }
                    }
                    continue;
                }

                $children = collect($group['questions'])
                    ->filter(fn (array $tuple) => ! in_array((int) $tuple[1]->id, $existingVersionIds, true))
                    ->sortBy(function (array $tuple): string {
                        return sprintf('%010d-%010d', $this->sourceQuestionNumber($tuple[2]) ?? PHP_INT_MAX, (int) ($tuple[3] ?? PHP_INT_MAX));
                    })
                    ->values();
                if ($children->isEmpty()) {
                    continue;
                }

                $passage = trim((string) ($meta['passage'] ?? ''));
                if ($passage === '') {
                    throw ValidationException::withMessages([
                        'question_ids' => "Reading questions in '{$meta['title']}' are missing their source passage. Add the passage before importing.",
                    ]);
                }

                $childPayload = $children->values()->map(function (array $tuple, int $index): array {
                    [$question, $version, $sourceSettings] = $tuple;
                    $type = $question->type instanceof QuestionType ? $question->type->value : (string) $question->type;
                    $payload = [
                        'id' => 'ai-question-version-'.$version->id,
                        'type' => $type,
                        'content' => $this->removeQuestionNumber((array) $version->content_json),
                        'answer_key' => (array) ($version->answer_key_json ?? []),
                        'position' => $index + 1,
                        'points' => 1,
                        'source_question_id' => (int) $question->id,
                        'source_question_version_id' => (int) $version->id,
                    ];
                    if (($number = $this->sourceQuestionNumber($sourceSettings)) !== null) {
                        $payload['source_question_number'] = $number;
                    }
                    if ($version->explanation) {
                        $payload['explanation'] = $version->explanation;
                    }

                    return $payload;
                })->all();

                $block = $draft->blocks()->create([
                    'lesson_id' => $lockedLesson->id,
                    'question_version_id' => null,
                    'block_type' => 'reading_comprehension',
                    'content_json' => [
                        'title' => $meta['title'],
                        'passage' => $passage,
                        'instructions' => 'Read the passage and answer the questions.',
                        'questions' => $childPayload,
                    ],
                    'answer_key_json' => null,
                    'settings_json' => [
                        'skill' => 'READING',
                        'activity_group_id' => $meta['activity_id'],
                        'activity_group_type' => 'READING',
                        'activity_group_title' => $meta['title'],
                        'reading_group_id' => $meta['passage_key'] ?: $meta['activity_id'],
                        'source_ai_group_key' => $meta['key'],
                        'source_group_key' => $meta['source_group'],
                        'source_passage_key' => $meta['passage_key'],
                        'source_passage_text' => $passage,
                        'source_question_version_ids' => collect($childPayload)->pluck('source_question_version_id')->values()->all(),
                        'source_preserve_exact' => $meta['preserve_exact'],
                        'imported_from_ai' => true,
                    ],
                    'points' => count($childPayload),
                    'position' => $position++,
                    'required' => false,
                    'grading_mode' => 'AUTO',
                ]);
                $created->push($block);
                $createdOrder[$block->id] = $group['first_order'] ?? PHP_INT_MAX;
                $existingImportedGroups[] = $meta['key'];
            }

            // Restore one global source order after grouping Reading children.
            // Temporary positions avoid collisions with the unique lesson/position index.
            $created = $created->sortBy(fn (LessonBlock $block) => (int) ($createdOrder[$block->id] ?? PHP_INT_MAX))->values();
            $temporaryPosition = max($occupied ? max($occupied) : 0, $position) + 100000;
            foreach ($created as $index => $block) {
                $block->update(['position' => $temporaryPosition + $index]);
            }
            foreach ($created as $index => $block) {
                $block->update(['position' => $position - $created->count() + $index]);
            }

            $lockedLesson->update(['updated_by' => $actor->id, 'lock_version' => ((int) $lockedLesson->lock_version) + 1]);
            return $created;
        });
    }

    private function draftVersion(Lesson $lesson, User $actor): LessonVersion
    {
        $draft = LessonVersion::query()->where('lesson_id', $lesson->id)->where('status', 'DRAFT')->lockForUpdate()->first();
        $published = $lesson->published_version_id ? LessonVersion::query()->whereKey($lesson->published_version_id)->first() : null;
        if ($draft) {
            if ($draft->blocks()->doesntExist() && $published) {
                $this->cloneBlocks($lesson, $draft, $published);
            }
            return $draft;
        }

        $draft = $lesson->versions()->create([
            'version_number' => ((int) $lesson->versions()->max('version_number')) + 1,
            'title_snapshot' => $lesson->title,
            'description_snapshot' => $lesson->description,
            'instructions_snapshot' => $lesson->instructions,
            'learning_objectives_json' => $lesson->learning_objectives_json,
            'status' => 'DRAFT',
            'lock_version' => 1,
            'created_by' => $actor->id,
        ]);
        if ($published) {
            $this->cloneBlocks($lesson, $draft, $published);
        }
        return $draft;
    }

    private function cloneBlocks(Lesson $lesson, LessonVersion $draft, LessonVersion $published): void
    {
        foreach (LessonBlock::query()->where('lesson_version_id', $published->id)->orderBy('position')->get() as $source) {
            $draft->blocks()->create([
                'lesson_id' => $lesson->id,
                'question_version_id' => $source->question_version_id,
                'block_type' => $source->block_type->value,
                'content_json' => $source->content_json,
                'answer_key_json' => $source->answer_key_json,
                'settings_json' => $source->settings_json,
                'schema_version' => $source->schema_version,
                'points' => $source->points,
                'position' => $source->position,
                'required' => $source->required,
                'grading_mode' => $source->grading_mode->value,
            ]);
        }
    }

    private function nextPosition(LessonVersion $draft, array $occupied): int
    {
        $base = ((int) $draft->id) * 100000;
        $position = max($base + 1, ((int) $draft->blocks()->max('position')) + 1);
        while (in_array($position, $occupied, true)) $position++;
        return $position;
    }

    private function gradingMode(string $type): string
    {
        return in_array($type, [QuestionType::OPEN_RESPONSE->value, 'speaking_prompt'], true) ? 'TEACHER' : 'AUTO';
    }
    private function normalizeNestedQuestionContent(array $content): array
    {
        if (is_string($content['prompt'] ?? null)) {
            $content = $this->removeQuestionNumber($content);
        }
        if (is_array($content['questions'] ?? null)) {
            $content['questions'] = array_map(function ($question) {
                if (! is_array($question)) {
                    return $question;
                }
                if (is_array($question['content'] ?? null)) {
                    $question['content'] = $this->removeQuestionNumber($question['content']);
                } elseif (is_string($question['prompt'] ?? null)) {
                    $question = $this->removeQuestionNumber($question);
                }
                return $question;
            }, $content['questions']);
        }

        return $content;
    }

    /** Remove source numbering and embedded A/B/C/D options from the prompt. */
    private function removeQuestionNumber(array $content): array
    {
        if (is_string($content['prompt'] ?? null)) {
            $content['prompt'] = app(QuestionPromptNormalizer::class)->normalize($content['prompt']);
        }

        return $content;
    }

    private function sourceQuestionNumber(array $settings): ?int
    {
        $value = $settings['source_question_number'] ?? null;
        if (is_int($value)) {
            return $value;
        }
        if (is_string($value) && preg_match('/\d+/', $value, $matches)) {
            return (int) $matches[0];
        }

        return null;
    }

    private function isReadingQuestion(Question $question, array $settings): bool
    {
        $activity = strtoupper((string) ($settings['source_activity_type'] ?? ''));
        $category = strtolower((string) ($question->english_category ?? ''));

        return $activity === 'READING'
            || $category === 'reading'
            || trim((string) ($settings['source_passage_key'] ?? '')) !== ''
            || trim((string) ($settings['source_passage_text'] ?? '')) !== '';
    }

    /** @return array{key:string, source_group:string, passage_key:string, passage:string, title:string, activity_id:string, preserve_exact:bool} */
    private function readingGroup(Question $question, array $settings): array
    {
        $sourceGroup = trim((string) ($settings['source_group_key'] ?? 'reading'));
        $passageKey = trim((string) ($settings['source_passage_key'] ?? ''));
        $passage = trim((string) ($settings['source_passage_text'] ?? ''));
        if ($passageKey === '' && $passage !== '') {
            $passageKey = 'reading:'.substr(hash('sha1', $passage), 0, 16);
        }
        $seed = $sourceGroup.'|'.($passageKey !== '' ? $passageKey : 'passage');
        $activityId = 'ai:'.((int) ($question->ai_generation_job_id ?? 0)).':'.substr(hash('sha1', $seed), 0, 16);
        $title = trim((string) ($settings['source_section_title'] ?? 'Reading')) ?: 'Reading';

        return [
            'key' => $activityId,
            'source_group' => $sourceGroup,
            'passage_key' => $passageKey,
            'passage' => $passage,
            'title' => $title,
            'activity_id' => $activityId,
            'preserve_exact' => (bool) ($settings['source_preserve_exact'] ?? false),
        ];
    }
}
