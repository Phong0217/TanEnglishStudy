<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignmentDelivery;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Lesson;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StudentContentController extends Controller
{
    public function classes(Request $request): Response
    {
        $classes = Classroom::with('courseVersion.course', 'primaryTeacher')->whereHas('enrollments', fn ($q) => $q->where('student_id', $request->user()->id)->where('status', 'ACTIVE'))->get();

        return Inertia::render('Student/Classes', ['classes' => $classes]);
    }

    public function lessons(Request $request): Response
    {
        $versionIds = Classroom::whereHas('enrollments', fn ($q) => $q->where('student_id', $request->user()->id)->where('status', 'ACTIVE'))->pluck('course_version_id');
        $lessons = Lesson::with('unit.courseVersion.course')->where('status', 'PUBLISHED')->whereHas('unit', fn ($q) => $q->whereIn('course_version_id', $versionIds))->orderBy('position')->paginate(15);

        return Inertia::render('Student/Lessons', ['lessons' => $lessons]);
    }

    public function assignments(Request $request): Response
    {
        $classIds = $request->user()->enrollments()->where('status', 'ACTIVE')->pluck('classroom_id');
        // Keep only the newest active delivery for each classroom/lesson.
        // This also protects students with legacy duplicate deliveries that
        // were created before old versions were closed during reassignment.
        $deliveries = AssignmentDelivery::query()
            ->from('assignment_deliveries')
            ->join('assignment_versions as current_versions', 'current_versions.id', '=', 'assignment_deliveries.assignment_version_id')
            ->join('assignments as current_assignments', 'current_assignments.id', '=', 'current_versions.assignment_id')
            ->with('assignmentVersion.assignment', 'classroom')
            ->whereNull('current_assignments.deleted_at')
            ->whereIn('assignment_deliveries.classroom_id', $classIds)
            ->whereIn('assignment_deliveries.status', ['OPEN', 'SCHEDULED'])
            ->whereNotExists(function (Builder $query): void {
                $query->selectRaw('1')
                    ->from('assignment_deliveries as newer_deliveries')
                    ->join('assignment_versions as newer_versions', 'newer_versions.id', '=', 'newer_deliveries.assignment_version_id')
                    ->join('assignments as newer_assignments', 'newer_assignments.id', '=', 'newer_versions.assignment_id')
                    ->whereColumn('newer_deliveries.classroom_id', 'assignment_deliveries.classroom_id')
                    ->whereColumn('newer_deliveries.id', '>', 'assignment_deliveries.id')
                    ->whereIn('newer_deliveries.status', ['OPEN', 'SCHEDULED'])
                    ->whereNull('newer_assignments.deleted_at')
                    ->where(function (Builder $match): void {
                        $match->where(function (Builder $lesson): void {
                            $lesson->whereNotNull('current_assignments.source_lesson_id')
                                ->whereColumn('newer_assignments.source_lesson_id', 'current_assignments.source_lesson_id');
                        })->orWhere(function (Builder $manual): void {
                            $manual->whereNull('current_assignments.source_lesson_id')
                                ->whereColumn('newer_assignments.id', 'current_assignments.id');
                        });
                    });
            })
            ->select('assignment_deliveries.*')
            ->orderBy('assignment_deliveries.due_at')
            ->paginate(15);

        return Inertia::render('Student/Assignments', ['deliveries' => $deliveries]);
    }

    public function assignment(Request $request, AssignmentDelivery $delivery): Response
    {
        $this->authorize('view', $delivery);
        $delivery->load('assignmentVersion.assignment');
        $submissions = $delivery->submissions()
            ->where('student_id', $request->user()->id)
            ->with(['answers', 'grade'])
            ->latest('attempt_number')
            ->get();

        // Never send answer keys while an attempt is still editable.  Keys
        // are included only after a submitted attempt exists, review is
        // enabled for this delivery, and there is no active retry.
        $hasActiveAttempt = $submissions->contains(fn ($submission) => in_array($submission->status->value, ['IN_PROGRESS', 'RETURNED'], true));
        $hasSubmittedAttempt = $submissions->contains(fn ($submission) => in_array($submission->status->value, ['SUBMITTED', 'LATE', 'GRADED'], true));
        $canRevealCorrectAnswers = (bool) $delivery->allow_review
            && (bool) $delivery->show_correct_answers
            && $hasSubmittedAttempt
            && ! $hasActiveAttempt;

        $delivery->load(['assignmentVersion.items' => function ($query) use ($canRevealCorrectAnswers): void {
            $columns = ['id', 'assignment_version_id', 'source_lesson_block_id', 'item_type', 'content_snapshot_json', 'settings_snapshot_json', 'points', 'position'];
            if ($canRevealCorrectAnswers) {
                $columns[] = 'answer_key_snapshot_json';
            }
            $query->select($columns);
        }]);
        $delivery->setRelation('submissions', $submissions);

        return Inertia::render('Student/AssignmentPlayer', ['delivery' => $delivery]);
    }

    public function grades(Request $request): Response
    {
        $grades = Grade::with('submission.delivery.assignmentVersion.assignment')
            ->where('status', 'RELEASED')
            ->whereHas('submission', fn ($q) => $q->where('student_id', $request->user()->id))
            ->whereHas('submission.delivery.assignmentVersion.assignment')
            ->latest('released_at')->paginate(15);

        return Inertia::render('Student/Grades', ['grades' => $grades]);
    }
}
