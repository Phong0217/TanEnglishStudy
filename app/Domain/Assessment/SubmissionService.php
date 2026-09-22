<?php

namespace App\Domain\Assessment;

use App\Models\AssignmentDelivery;
use App\Models\Grade;
use App\Models\Submission;
use App\Models\SubmissionAnswer;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SubmissionService
{
    public function __construct(private readonly GradingService $grader) {}

    public function start(User $student, AssignmentDelivery $delivery): Submission
    {
        return DB::transaction(function () use ($student, $delivery) {
            $delivery = AssignmentDelivery::with('classroom')->lockForUpdate()->findOrFail($delivery->id);
            abort_unless($delivery->classroom->center_id === $student->center_id && $delivery->classroom->enrollments()->where('student_id', $student->id)->where('status', 'ACTIVE')->exists(), 403);
            $now = now();
            if ($delivery->open_at && $now->lt($delivery->open_at)) {
                throw ValidationException::withMessages(['assignment' => 'This assignment is not open yet.']);
            }
            // Scheduled deliveries become active on first access once their
            // opening time has passed. This keeps the persisted status in sync
            // with the authoritative timestamp and avoids a stale SCHEDULED
            // badge blocking a lesson that is already open.
            if ($delivery->status === 'SCHEDULED' && (! $delivery->open_at || $now->gte($delivery->open_at))) {
                $delivery->update(['status' => 'OPEN']);
            }
            if ($delivery->close_at && $now->gt($delivery->close_at) && ! $delivery->allow_late_submission) {
                throw ValidationException::withMessages(['assignment' => 'This assignment is closed.']);
            }
            $current = $delivery->submissions()->where('student_id', $student->id)->whereIn('status', ['IN_PROGRESS', 'RETURNED'])->latest('attempt_number')->with('answers')->first();
            if ($current) {
                return $current;
            }
            $attempt = (int) $delivery->submissions()->where('student_id', $student->id)->max('attempt_number') + 1;
            if ($attempt > $delivery->max_attempts) {
                throw ValidationException::withMessages(['assignment' => 'No attempts remain.']);
            }

            return Submission::create(['assignment_delivery_id' => $delivery->id, 'student_id' => $student->id, 'attempt_number' => $attempt, 'status' => 'IN_PROGRESS', 'started_at' => $now])->load('answers');
        });
    }

    public function saveAnswer(User $student, Submission $submission, int $itemId, ?array $response): SubmissionAnswer
    {
        abort_unless($submission->student_id === $student->id, 403);
        if (! in_array($submission->status->value, ['IN_PROGRESS', 'RETURNED'], true)) {
            throw ValidationException::withMessages(['submission' => 'Submitted work cannot be edited.']);
        }
        abort_unless($submission->delivery->assignmentVersion->items()->whereKey($itemId)->exists(), 422);
        $answer = SubmissionAnswer::updateOrCreate(['submission_id' => $submission->id, 'assignment_item_id' => $itemId], ['response_json' => $response, 'grading_status' => 'PENDING']);
        $submission->update(['last_saved_at' => now()]);

        return $answer;
    }

    public function submit(User $student, Submission $submission): Submission
    {
        abort_unless($submission->student_id === $student->id, 403);

        return DB::transaction(function () use ($submission) {
            $submission = Submission::lockForUpdate()->findOrFail($submission->id);
            if (in_array($submission->status->value, ['SUBMITTED', 'LATE', 'GRADED'], true)) {
                return $submission->load('grade');
            }$delivery = $submission->delivery;
            $deadline = $delivery->time_limit_minutes ? $submission->started_at->copy()->addMinutes($delivery->time_limit_minutes) : $delivery->due_at;
            $late = $deadline && now()->gt($deadline);
            if ($delivery->close_at && now()->gt($delivery->close_at) && ! $delivery->allow_late_submission) {
                throw ValidationException::withMessages(['submission' => 'The submission window has closed.']);
            }$items = $delivery->assignmentVersion->items;
            foreach ($items as $item) {
                $answer = SubmissionAnswer::firstOrCreate(['submission_id' => $submission->id, 'assignment_item_id' => $item->id]);
                $score = $this->grader->grade($item, $answer->response_json);
                $answer->update(['auto_score' => $score, 'final_score' => $score, 'grading_status' => $score === null ? 'NEEDS_REVIEW' : 'AUTO_GRADED', 'graded_at' => $score === null ? null : now()]);
            }$submission->update(['status' => $late ? 'LATE' : 'SUBMITTED', 'submitted_at' => now(), 'last_saved_at' => now()]);
            $answers = $submission->answers()->get();
            $auto = (float) $answers->sum('auto_score');
            $needsReview = $answers->contains('grading_status', 'NEEDS_REVIEW');
            // Auto-graded submissions are complete as soon as the learner
            // submits them.  Release those results immediately when the
            // delivery is configured for AFTER_GRADING; manually reviewed
            // submissions remain hidden until a teacher releases them.
            $gradedAt = $needsReview ? null : now();
            $autoRelease = ! $needsReview && strtoupper((string) $delivery->result_release_policy) === 'AFTER_GRADING';
            Grade::updateOrCreate(['submission_id' => $submission->id], [
                'auto_score' => $auto,
                'final_score' => $auto,
                'status' => $autoRelease ? 'RELEASED' : ($needsReview ? 'DRAFT' : 'GRADED'),
                'graded_at' => $gradedAt,
                'released_at' => $autoRelease ? $gradedAt : null,
            ]);
            $delivery->classroom->teacherAssignments()->where('status', 'ACTIVE')->with('teacher')->get()->each(fn ($assignment) => $assignment->teacher->notify(new SystemNotification('Submission received', 'A student submitted '.$delivery->assignmentVersion->assignment->title, '/teacher/submissions')));

            return $submission->load('answers', 'grade');
        });
    }
}
