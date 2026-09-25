<?php

namespace App\Http\Controllers;

use App\Enums\RoleName;
use App\Models\AssignmentDelivery;
use App\Models\AuditLog;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function admin(Request $request): Response
    {
        $center = $request->user()->center_id;
        $submissions = Submission::whereHas('delivery.classroom', fn ($q) => $q->where('center_id', $center));
        $stats = ['Total Teachers' => User::role(RoleName::TEACHER->value)->where('center_id', $center)->count(), 'Active Teachers' => User::role(RoleName::TEACHER->value)->where('center_id', $center)->where('status', 'ACTIVE')->count(), 'Total Students' => User::role(RoleName::STUDENT->value)->where('center_id', $center)->count(), 'Active Students' => User::role(RoleName::STUDENT->value)->where('center_id', $center)->where('status', 'ACTIVE')->count(), 'Active Classrooms' => Classroom::where('status', 'ACTIVE')->count(), 'Total Courses' => Course::count(), 'Published Lessons' => Lesson::whereHas('creator', fn ($q) => $q->where('center_id', $center))->where('status', 'PUBLISHED')->count(), 'Pending Grading' => (clone $submissions)->whereHas('answers', fn ($q) => $q->where('grading_status', 'NEEDS_REVIEW'))->count()];

        $upcoming = AssignmentDelivery::with('assignmentVersion.assignment', 'classroom')->whereHas('assignmentVersion.assignment')->whereHas('classroom', fn ($q) => $q->where('center_id', $center))->whereIn('status', ['OPEN', 'SCHEDULED'])->whereBetween('due_at', [now(), now()->addDays(14)])->orderBy('due_at')->limit(6)->get()->map(fn ($d) => ['title' => $d->assignmentVersion?->assignment?->title ?? 'Assignment', 'classroom' => $d->classroom?->name ?? 'Classroom', 'dueAt' => $d->due_at]);

        return Inertia::render('AppDashboard', ['title' => 'Admin Dashboard', 'stats' => $stats, 'upcoming' => $upcoming, 'recent' => AuditLog::latest()->limit(8)->get()->map(fn ($a) => ['action' => $a->action, 'entity' => $a->entity_type, 'at' => $a->created_at])]);
    }

    public function teacher(Request $request): Response
    {
        $ids = $request->user()->teachingAssignments()->where('status', 'ACTIVE')->pluck('classroom_id');
        $stats = ['My Classes' => $ids->count(), 'My Students' => Enrollment::whereIn('classroom_id', $ids)->where('status', 'ACTIVE')->distinct('student_id')->count('student_id'), 'Active Assignments' => AssignmentDelivery::whereIn('classroom_id', $ids)->where('status', 'OPEN')->count(), 'Pending Grading' => Submission::whereHas('delivery', fn ($q) => $q->whereIn('classroom_id', $ids))->whereHas('answers', fn ($q) => $q->where('grading_status', 'NEEDS_REVIEW'))->count()];

        $upcoming = AssignmentDelivery::with('assignmentVersion.assignment', 'classroom')->whereHas('assignmentVersion.assignment')->whereIn('classroom_id', $ids)->whereIn('status', ['OPEN', 'SCHEDULED'])->whereNotNull('due_at')->orderBy('due_at')->limit(6)->get()->map(fn ($d) => ['title' => $d->assignmentVersion?->assignment?->title ?? 'Assignment', 'classroom' => $d->classroom?->name ?? 'Classroom', 'dueAt' => $d->due_at]);

        return Inertia::render('AppDashboard', ['title' => 'Teacher Dashboard', 'stats' => $stats, 'upcoming' => $upcoming, 'recent' => []]);
    }

    public function student(Request $request): Response
    {
        $studentId = $request->user()->id;
        $ids = $request->user()->enrollments()->where('status', 'ACTIVE')->pluck('classroom_id');
        $deliveries = AssignmentDelivery::query()
            ->with([
                'assignmentVersion.assignment',
                'classroom',
                'submissions' => fn ($query) => $query->where('student_id', $studentId)->latest('attempt_number'),
            ])
            ->whereIn('classroom_id', $ids)
            ->whereIn('status', ['OPEN', 'SCHEDULED'])
            ->whereHas('assignmentVersion.assignment')
            ->where(function ($query): void {
                $query->whereNull('open_at')->orWhere('open_at', '<=', now());
            })
            ->orderBy('due_at')
            ->get()
            ->filter(function (AssignmentDelivery $delivery): bool {
                $statuses = $delivery->submissions->map(function ($submission): string {
                    $status = $submission->status;
                    return $status instanceof \BackedEnum ? $status->value : (string) $status;
                });
                return ! $statuses->intersect(['SUBMITTED', 'LATE', 'GRADED'])->isNotEmpty()
                    || $statuses->intersect(['IN_PROGRESS', 'RETURNED'])->isNotEmpty();
            })
            ->unique(function (AssignmentDelivery $delivery): string {
                $assignment = $delivery->assignmentVersion?->assignment;
                return ($assignment?->source_lesson_id ? 'lesson:' . $assignment->source_lesson_id : 'assignment:' . ($assignment?->id ?? $delivery->id)) . ':class:' . $delivery->classroom_id;
            })
            ->values();

        $upcoming = $deliveries->take(6)->map(function (AssignmentDelivery $delivery): array {
            $submissions = $delivery->submissions;
            $latest = $submissions->sortByDesc('attempt_number')->first();
            $status = $latest?->status;
            $statusValue = $status instanceof \BackedEnum ? $status->value : ($status ? (string) $status : null);
            $actionLabel = in_array($statusValue, ['IN_PROGRESS', 'RETURNED'], true) ? 'Tiếp tục làm' : 'Bắt đầu làm bài';

            return [
                'title' => $delivery->assignmentVersion?->assignment?->title ?? 'Bài học tiếng Anh',
                'classroom' => $delivery->classroom?->name ?? 'Lớp học',
                'dueAt' => $delivery->due_at,
                'url' => route('student.assignments.show', $delivery),
                'actionLabel' => $actionLabel,
                'status' => $statusValue,
            ];
        })->values();

        $allCompleted = Submission::where('student_id', $studentId)->whereIn('status', ['SUBMITTED', 'LATE', 'GRADED'])->count();
        $stats = [
            'My Classes' => $ids->count(),
            'Assignments Due' => $upcoming->count(),
            'Completed Assignments' => $allCompleted,
            'Released Grades' => Grade::whereHas('submission', fn ($q) => $q->where('student_id', $studentId))->where('status', 'RELEASED')->count(),
        ];

        return Inertia::render('AppDashboard', ['title' => 'Learning Home', 'stats' => $stats, 'upcoming' => $upcoming, 'recent' => []]);
    }
}
