<?php

namespace App\Domain\Assessment;

use App\Models\AssignmentDelivery;
use App\Models\AssignmentVersion;
use App\Models\Classroom;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DeliverAssignmentAction
{
    public function execute(User $actor, AssignmentVersion $version, Classroom $classroom, array $data): AssignmentDelivery
    {
        if ($version->assignment->center_id !== $actor->center_id || $classroom->center_id !== $actor->center_id) {
            abort(404);
        }
        if ($version->total_points <= 0) {
            throw ValidationException::withMessages(['assignment' => 'The assignment must have positive total points.']);
        }

        return DB::transaction(function () use ($actor, $version, $classroom, $data) {
            $locked = AssignmentVersion::lockForUpdate()->findOrFail($version->id);
            $delivery = AssignmentDelivery::create(['assignment_version_id' => $locked->id, 'classroom_id' => $classroom->id, 'status' => now()->gte($data['open_at']) ? 'OPEN' : 'SCHEDULED', 'open_at' => $data['open_at'], 'due_at' => $data['due_at'], 'close_at' => $data['close_at'] ?? $data['due_at'], 'max_attempts' => $data['max_attempts'], 'time_limit_minutes' => $data['time_limit_minutes'] ?? null, 'allow_late_submission' => $data['allow_late_submission'] ?? false, 'allow_review' => $data['allow_review'] ?? false, 'show_correct_answers' => ($data['allow_review'] ?? false) && ($data['show_correct_answers'] ?? false), 'result_release_policy' => $data['result_release_policy'], 'assigned_by' => $actor->id]);
            $locked->update(['is_locked' => true, 'published_at' => $locked->published_at ?? now()]);
            $locked->assignment->update(['status' => 'PUBLISHED']);
            $classroom->enrollments()->where('status', 'ACTIVE')->with('student')->get()->each(fn ($enrollment) => $enrollment->student->notify(new SystemNotification('Assignment published', $locked->assignment->title.' is now available.', '/student/assignments')));

            return $delivery;
        });
    }
}
