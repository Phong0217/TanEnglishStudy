<?php

namespace App\Domain\Assessment;

use App\Models\Grade;
use App\Models\GradeAudit;
use App\Models\Submission;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GradeService
{
    public function grade(User $actor, Submission $submission, array $scores, ?string $feedback, string $reason): Grade
    {
        return DB::transaction(function () use ($actor, $submission, $scores, $feedback, $reason) {
            $grade = Grade::where('submission_id', $submission->id)->lockForUpdate()->firstOrFail();
            $old = $grade->final_score;
            foreach ($scores as $answerId => $score) {
                $answer = $submission->answers()->with('item')->findOrFail($answerId);
                $value = (float) $score;
                if ($value < 0 || $value > (float) $answer->item->points) {
                    throw ValidationException::withMessages(['scores' => "A score must be between 0 and {$answer->item->points}."]);
                }$answer->update(['manual_score' => $value, 'final_score' => $value, 'grading_status' => 'GRADED', 'graded_by' => $actor->id, 'graded_at' => now()]);
            }$final = (float) $submission->answers()->sum('final_score');
            $max = (float) $submission->delivery->assignmentVersion->total_points;
            if ($final < 0 || $final > $max) {
                throw ValidationException::withMessages(['scores' => 'The final grade is outside the allowed range.']);
            }$grade->update(['manual_score' => $submission->answers()->sum('manual_score'), 'final_score' => $final, 'status' => 'GRADED', 'general_feedback' => $feedback, 'graded_by' => $actor->id, 'graded_at' => now()]);
            GradeAudit::create(['grade_id' => $grade->id, 'submission_id' => $submission->id, 'old_score' => $old, 'new_score' => $final, 'old_status' => $grade->getOriginal('status'), 'new_status' => 'GRADED', 'reason' => $reason, 'changed_by' => $actor->id]);
            $submission->update(['status' => 'GRADED']);

            return $grade;
        });
    }

    public function release(User $actor, Grade $grade): Grade
    {
        return DB::transaction(function () use ($actor, $grade) {
            $grade = Grade::lockForUpdate()->findOrFail($grade->id);
            if ($grade->status->value === 'DRAFT') {
                throw ValidationException::withMessages(['grade' => 'Finish grading before release.']);
            }$old = $grade->status->value;
            $grade->update(['status' => 'RELEASED', 'released_at' => now()]);
            GradeAudit::create(['grade_id' => $grade->id, 'submission_id' => $grade->submission_id, 'old_score' => $grade->final_score, 'new_score' => $grade->final_score, 'old_status' => $old, 'new_status' => 'RELEASED', 'reason' => 'Grade released to student', 'changed_by' => $actor->id]);
            $grade->submission->student->notify(new SystemNotification('Grade released', 'A new grade is available.', '/student/grades'));

            return $grade;
        });
    }
}
