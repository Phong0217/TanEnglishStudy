<?php

namespace App\Domain\Assessment;

use App\Domain\AI\AuthoringScope;
use App\Models\Assignment;
use App\Models\AssignmentItem;
use App\Models\AssignmentVersion;
use App\Models\Lesson;
use App\Models\LessonBlock;
use App\Models\QuestionVersion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateAssignmentAction
{
    public function execute(User $actor, array $data): Assignment
    {
        return DB::transaction(function () use ($actor, $data) {
            $sourceLessonVersionId = null;
            if (! empty($data['source_lesson_id'])) {
                $sourceLesson = Lesson::with('publishedVersion', 'creator')->findOrFail($data['source_lesson_id']);
                abort_unless($sourceLesson->creator?->center_id === $actor->center_id, 403);
                $sourceLessonVersionId = $sourceLesson->published_version_id;
            }
            $assignment = Assignment::create(['center_id' => $actor->center_id, 'source_lesson_id' => $data['source_lesson_id'] ?? null, 'title' => $data['title'], 'description' => $data['description'] ?? null, 'status' => 'DRAFT', 'created_by' => $actor->id]);
            $version = AssignmentVersion::create(['assignment_id' => $assignment->id, 'source_lesson_version_id' => $sourceLessonVersionId, 'version_number' => 1, 'instructions' => $data['instructions'] ?? null, 'total_points' => 0, 'grading_settings_json' => $data['grading_settings'] ?? [], 'created_by' => $actor->id]);
            $position = 1;
            $total = 0.0;
            foreach ($data['items'] as $input) {
                $source = isset($input['question_version_id'])
                    ? QuestionVersion::with('question')->findOrFail($input['question_version_id'])
                    : LessonBlock::with('lesson.creator')->findOrFail($input['lesson_block_id']);
                $centerId = $source instanceof QuestionVersion ? $source->question->center_id : $source->lesson->creator?->center_id;
                if ($centerId !== $actor->center_id) {
                    throw ValidationException::withMessages(['items' => 'Every item must belong to your center.']);
                }
                if ($source instanceof QuestionVersion) {
                    abort_unless($source->question->status === 'APPROVED' && app(AuthoringScope::class)->questions($actor)->whereKey($source->question_id)->exists(), 403);
                }
                $points = (float) ($input['points'] ?? $source->points ?? 1);
                if ($points <= 0) {
                    throw ValidationException::withMessages(['items' => 'Every assignment item must have positive points.']);
                }
                AssignmentItem::create([
                    'assignment_version_id' => $version->id,
                    'question_version_id' => $source instanceof QuestionVersion ? $source->id : null,
                    'source_lesson_block_id' => $source instanceof LessonBlock ? $source->id : null,
                    'item_type' => $source instanceof QuestionVersion ? $source->question->type->value : $source->block_type->value,
                    'content_snapshot_json' => $source->content_json,
                    'answer_key_snapshot_json' => $source->answer_key_json,
                    'settings_snapshot_json' => $source->settings_json ?? [],
                    'explanation_snapshot' => $source->explanation ?? null,
                    'rubric_snapshot' => $source->rubric ?? null,
                    'points' => $points, 'position' => $position++,
                ]);
                $total += $points;
            }
            $version->update(['total_points' => $total]);

            return $assignment->load('versions.items');
        });
    }
}
