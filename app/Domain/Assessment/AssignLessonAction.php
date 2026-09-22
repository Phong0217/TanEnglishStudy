<?php

namespace App\Domain\Assessment;

use App\Enums\RoleName;
use App\Enums\BlockType;
use App\Models\Assignment;
use App\Models\AssignmentDelivery;
use App\Models\AssignmentItem;
use App\Models\AssignmentVersion;
use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AssignLessonAction
{
    /** @return Collection<int, AssignmentDelivery> */
    public function execute(User $actor, Lesson $lesson, array $data): Collection
    {
        return DB::transaction(function () use ($actor, $lesson, $data) {
            $lesson = Lesson::with('creator', 'publishedVersion.blocks')->lockForUpdate()->findOrFail($lesson->id);
            abort_unless($lesson->status->value === 'PUBLISHED' && $lesson->publishedVersion, 422, 'Publish the lesson before assigning it.');
            abort_unless($lesson->creator?->center_id === $actor->center_id, 403);

            $classrooms = Classroom::where('center_id', $actor->center_id)
                ->whereIn('id', $data['classroom_ids'])
                ->where('status', 'ACTIVE')
                ->when($actor->hasRole(RoleName::TEACHER->value), fn ($q) => $q->whereHas('teacherAssignments', fn ($t) => $t->where('teacher_id', $actor->id)->where('status', 'ACTIVE')))
                ->lockForUpdate()->get();

            if ($classrooms->count() !== count(array_unique(array_map('intval', $data['classroom_ids'])))) {
                throw ValidationException::withMessages(['classroom_ids' => 'One or more classrooms are outside your permission scope.']);
            }

            $published = $lesson->publishedVersion;
            if ($published->blocks->isEmpty()) {
                throw ValidationException::withMessages(['lesson' => 'The published lesson has no content. Save and publish its blocks before assigning it.']);
            }
            $assignment = Assignment::where('source_lesson_id', $lesson->id)->where('center_id', $actor->center_id)->lockForUpdate()->first();
            if (! $assignment) {
                $assignment = Assignment::create(['center_id' => $actor->center_id, 'source_lesson_id' => $lesson->id, 'title' => $lesson->title, 'description' => $lesson->description, 'status' => 'DRAFT', 'created_by' => $actor->id]);
            }

            $version = $assignment->versions()->where('source_lesson_version_id', $published->id)->first();
            $createdVersion = false;
            if (! $version) {
                $createdVersion = true;
                $version = AssignmentVersion::create(['assignment_id' => $assignment->id, 'source_lesson_version_id' => $published->id, 'version_number' => ((int) $assignment->versions()->max('version_number')) + 1, 'instructions' => $lesson->instructions, 'total_points' => 0, 'grading_settings_json' => [], 'created_by' => $actor->id]);
                $total = 0.0;
                $itemPosition = 0;
                foreach ($this->flattenBlocks($published->blocks) as $block) {
                    $points = (float) $block->points;
                    if ($points < 0) throw ValidationException::withMessages(['lesson' => 'Lesson contains a block with invalid points.']);
                    $content = $block->content_json ?? [];
                    if ($block->block_type->value === 'reading_comprehension' && isset($content['questions']) && is_array($content['questions'])) {
                        $activityId = (string) (($block->settings_json ?? [])['activity_group_id'] ?? $block->id);
                        foreach ($content['questions'] as $question) {
                            $questionContent = $question['content'] ?? collect($question)->except(['id', 'type', 'answer_key', 'explanation'])->all();
                            $questionType = ($question['type'] ?? 'multiple_choice') === 'image_choice' ? 'multiple_choice' : ($question['type'] ?? 'multiple_choice');
                            $questionSettings = array_merge($block->settings_json ?? [], [
                                'reading_group_id' => $activityId,
                                'reading_title' => $content['title'] ?? '',
                                'reading_instructions' => $content['instructions'] ?? '',
                            ]);
                            $readingContent = array_merge($questionContent, [
                                'reading_passage' => $content['passage'] ?? '',
                                'reading_title' => $content['title'] ?? '',
                                'reading_instructions' => $content['instructions'] ?? '',
                                'reading_group_id' => $activityId,
                            ]);
                            AssignmentItem::create(['assignment_version_id' => $version->id, 'source_lesson_block_id' => $block->id, 'item_type' => $questionType, 'content_snapshot_json' => $readingContent, 'answer_key_snapshot_json' => $question['answer_key'] ?? [], 'settings_snapshot_json' => $questionSettings, 'points' => $points, 'position' => ++$itemPosition]);
                            $total += $points;
                        }
                    } elseif ($block->block_type->value === 'listening_question' && isset($content['questions']) && is_array($content['questions'])) {
                        $activityId = (string) (($block->settings_json ?? [])['activity_group_id'] ?? $block->id);
                        $audioAssetId = $content['audioAssetId'] ?? null;
                        $audioUrl = $content['audio_url'] ?? ($audioAssetId ? route('media-assets.stream', $audioAssetId) : null);
                        foreach ($content['questions'] as $question) {
                            $questionContent = $question['content'] ?? collect($question)->except(['id', 'type', 'answer_key', 'explanation'])->all();
                            $questionType = ($question['type'] ?? 'multiple_choice') === 'image_choice' ? 'multiple_choice' : ($question['type'] ?? 'multiple_choice');
                            $answerDisplayType = (string) ($question['answer_display_type'] ?? $questionContent['answer_display_type'] ?? (($question['type'] ?? '') === 'image_choice' ? 'image' : 'text'));
                            $questionContent['answer_display_type'] = $answerDisplayType;
                            $questionSettings = array_merge($block->settings_json ?? [], [
                                'listening_group_id' => $activityId,
                                'listening_audio_asset_id' => $audioAssetId,
                                'listening_title' => $content['title'] ?? '',
                                'listening_instructions' => $content['instructions'] ?? '',
                                'listening_illustration_media_id' => $content['illustration_media_id'] ?? $content['illustrationMediaId'] ?? null,
                                // The example is presentation-only metadata. It is intentionally
                                // not materialized as an AssignmentItem or SubmissionAnswer.
                                'listening_example' => !empty($content['example']['enabled']) ? ($content['example'] ?? null) : null,
                                'answer_display_type' => $answerDisplayType,
                            ]);
                            AssignmentItem::create(['assignment_version_id' => $version->id, 'source_lesson_block_id' => $block->id, 'item_type' => $questionType, 'content_snapshot_json' => array_merge($questionContent, ['listening_audio_asset_id' => $audioAssetId, 'listening_audio_url' => $audioUrl, 'listening_group_id' => $activityId]), 'answer_key_snapshot_json' => $question['answer_key'] ?? [], 'settings_snapshot_json' => $questionSettings, 'points' => $points, 'position' => ++$itemPosition]);
                            $total += $points;
                        }
                    } else {
                        AssignmentItem::create(['assignment_version_id' => $version->id, 'source_lesson_block_id' => $block->id, 'item_type' => $block->block_type->value, 'content_snapshot_json' => $content, 'answer_key_snapshot_json' => $block->answer_key_json, 'settings_snapshot_json' => $block->settings_json ?? [], 'points' => $points, 'position' => ++$itemPosition]);
                        $total += $points;
                    }
                }
                $version->update(['total_points' => $total]);
            }

            // A new published version is an immutable assignment snapshot.
            // Retire older active deliveries for the selected classrooms so
            // students receive the newly assigned lesson instead of an older
            // snapshot that was left active by a previous publish.
            if ($createdVersion) {
                $previousVersionIds = $assignment->versions()
                    ->where('id', '<>', $version->id)
                    ->pluck('id');

                if ($previousVersionIds->isNotEmpty()) {
                    AssignmentDelivery::whereIn('assignment_version_id', $previousVersionIds)
                        ->whereIn('classroom_id', $classrooms->pluck('id'))
                        ->whereIn('status', ['OPEN', 'SCHEDULED'])
                        ->update(['status' => 'CLOSED', 'updated_at' => now()]);
                }
            }

            $existing = AssignmentDelivery::where('assignment_version_id', $version->id)->whereIn('classroom_id', $classrooms->pluck('id'))->pluck('classroom_id');
            $deliveries = collect();
            foreach ($classrooms as $classroom) {
                if ($existing->contains($classroom->id)) continue;
                $delivery = AssignmentDelivery::create(['assignment_version_id' => $version->id, 'classroom_id' => $classroom->id, 'status' => now()->gte($data['open_at']) ? 'OPEN' : 'SCHEDULED', 'open_at' => $data['open_at'], 'due_at' => $data['due_at'], 'close_at' => $data['close_at'] ?? $data['due_at'], 'max_attempts' => $data['max_attempts'], 'time_limit_minutes' => $data['time_limit_minutes'] ?? null, 'allow_late_submission' => $data['allow_late_submission'] ?? false, 'allow_review' => $data['allow_review'] ?? false, 'show_correct_answers' => ($data['allow_review'] ?? false) && ($data['show_correct_answers'] ?? false), 'result_release_policy' => $data['result_release_policy'], 'assigned_by' => $actor->id]);
                $deliveries->push($delivery);
                $classroom->enrollments()->where('status', 'ACTIVE')->with('student')->get()->each(fn ($enrollment) => $enrollment->student?->notify(new SystemNotification('Lesson assigned', $assignment->title.' is now available.', '/student/assignments')));
            }
            $version->update(['is_locked' => true, 'published_at' => $version->published_at ?? now()]);
            $assignment->update(['status' => 'PUBLISHED', 'updated_by' => $actor->id]);

            return $deliveries;
        });
    }

    /**
     * Sections are authoring-only containers. Published deliveries snapshot
     * their ordered children into the same immutable assignment version so the
     * student still completes one submission for the whole lesson.
     */
    private function flattenBlocks(Collection $blocks): array
    {
        $result = [];
        foreach ($blocks->sortBy('position') as $block) {
            if ($block->block_type->value !== BlockType::SECTION->value) {
                $settings = (array) ($block->settings_json ?? []);
                $activityId = (string) ($settings['activity_group_id'] ?? "activity:root:{$block->id}");
                $activityType = $this->activityType($block->block_type->value, $settings);
                $activityTitle = $this->activityTitle($block->block_type->value, (array) ($block->content_json ?? []), $activityType);
                $result[] = $this->withActivityContext($block, $settings, $activityId, $activityTitle, $activityType, 1, 'root', $activityTitle);
                continue;
            }
            $sectionContent = (array) ($block->content_json ?? []);
            $activities = collect(is_array($sectionContent['activities'] ?? null) ? $sectionContent['activities'] : []);
            $children = $sectionContent['children'] ?? [];
            foreach (is_array($children) ? $children : [] as $index => $child) {
                if (! is_array($child) || ! isset($child['block_type'])) {
                    continue;
                }
                $childType = BlockType::tryFrom((string) $child['block_type']);
                if (! $childType) {
                    continue;
                }
                $content = (array) ($child['content_json'] ?? []);
                $childSettings = (array) ($child['settings_json'] ?? []);
                $activityId = (string) ($childSettings['activity_group_id'] ?? $child['activity_group_id'] ?? "activity:section:{$block->id}:".($child['clientId'] ?? $child['id'] ?? $index));
                $activity = $activities->first(fn ($item) => is_array($item) && (string) ($item['id'] ?? '') === $activityId);
                $activityType = strtoupper((string) (($activity['type'] ?? null) ?: ($childSettings['activity_group_type'] ?? $this->activityType($childType->value, $childSettings))));
                $activityTitle = (string) (($activity['title'] ?? null) ?: ($childSettings['activity_group_title'] ?? $this->activityTitle($childType->value, $content, $activityType)));
                $activityPosition = (int) (($activity['position'] ?? null) ?: ($child['position'] ?? $index + 1));
                $settings = array_merge($childSettings, [
                    'section_id' => $block->id,
                    'section_title' => $sectionContent['title'] ?? '',
                    'section_skill' => $sectionContent['skill'] ?? 'MIXED',
                    'activity_group_id' => $activityId,
                    'activity_group_title' => $activityTitle,
                    'activity_group_type' => $activityType,
                    'activity_position' => $activityPosition,
                ]);
                $result[] = (object) [
                    'id' => $block->id,
                    'block_type' => $childType,
                    'content_json' => $content,
                    'answer_key_json' => $child['answer_key_json'] ?? null,
                    'settings_json' => $settings,
                    'points' => $child['points'] ?? 1,
                    'position' => (($block->position ?? $index) * 1000) + ($child['position'] ?? $index + 1),
                ];
            }
        }
        return $result;
    }

    private function withActivityContext(object $block, array $settings, string $activityId, string $activityTitle, string $activityType, int $activityPosition, string $sectionId, string $sectionTitle): object
    {
        $settings = array_merge($settings, [
            'section_id' => $sectionId,
            'section_title' => $sectionTitle,
            'section_skill' => $settings['skill'] ?? 'MIXED',
            'activity_group_id' => $activityId,
            'activity_group_title' => $settings['activity_group_title'] ?? $activityTitle,
            'activity_group_type' => $settings['activity_group_type'] ?? $activityType,
            'activity_position' => $settings['activity_position'] ?? $activityPosition,
        ]);
        $block->settings_json = $settings;

        return $block;
    }

    private function activityType(string $blockType, array $settings): string
    {
        $skill = strtoupper((string) ($settings['skill'] ?? ''));
        if (in_array($skill, ['LISTENING', 'READING', 'WRITING', 'SPEAKING', 'GRAMMAR', 'VOCABULARY', 'PRACTICE'], true)) {
            return $skill;
        }

        return match ($blockType) {
            'listening_question', 'audio' => 'LISTENING',
            'reading_passage', 'reading_comprehension' => 'READING',
            'open_response' => 'WRITING',
            'speaking_prompt' => 'SPEAKING',
            'grammar_explanation' => 'GRAMMAR',
            'vocabulary' => 'VOCABULARY',
            default => 'PRACTICE',
        };
    }

    private function activityTitle(string $blockType, array $content, string $activityType): string
    {
        if (! empty($content['title'])) {
            return (string) $content['title'];
        }

        return match ($activityType) {
            'LISTENING' => 'Listening',
            'READING' => 'Reading',
            'WRITING' => 'Writing',
            'SPEAKING' => 'Speaking',
            'GRAMMAR' => 'Grammar',
            'VOCABULARY' => 'Vocabulary',
            default => ucfirst(str_replace('_', ' ', $blockType)),
        };
    }
}
