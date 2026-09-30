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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function admin(Request $request): Response
    {
        $center = $request->user()->center_id;
        $classroomIds = Classroom::query()->where("center_id", $center)->where("status", "ACTIVE")->pluck("id");
        $submissions = Submission::whereHas('delivery.classroom', fn ($q) => $q->where('center_id', $center));
        $stats = ['Total Teachers' => User::role(RoleName::TEACHER->value)->where('center_id', $center)->count(), 'Active Teachers' => User::role(RoleName::TEACHER->value)->where('center_id', $center)->where('status', 'ACTIVE')->count(), 'Total Students' => User::role(RoleName::STUDENT->value)->where('center_id', $center)->count(), 'Active Students' => User::role(RoleName::STUDENT->value)->where('center_id', $center)->where('status', 'ACTIVE')->count(), 'Active Classrooms' => $classroomIds->count(), 'Total Courses' => Course::where('center_id', $center)->count(), 'Published Lessons' => Lesson::whereHas('creator', fn ($q) => $q->where('center_id', $center))->where('status', 'PUBLISHED')->count(), 'Pending Grading' => (clone $submissions)->whereHas('answers', fn ($q) => $q->where('grading_status', 'NEEDS_REVIEW'))->count()];

        $upcoming = AssignmentDelivery::with('assignmentVersion.assignment', 'classroom')->whereHas('assignmentVersion.assignment')->whereHas('classroom', fn ($q) => $q->where('center_id', $center))->whereIn('status', ['OPEN', 'SCHEDULED'])->whereBetween('due_at', [now(), now()->addDays(14)])->orderBy('due_at')->limit(6)->get()->map(fn ($d) => ['title' => $d->assignmentVersion?->assignment?->title ?? 'Assignment', 'classroom' => $d->classroom?->name ?? 'Classroom', 'dueAt' => $d->due_at]);

        return Inertia::render('AppDashboard', ['title' => 'Admin Dashboard', 'stats' => $stats, 'upcoming' => $upcoming, 'recent' => AuditLog::where('center_id', $center)->latest()->limit(8)->get()->map(fn ($a) => ['action' => $a->action, 'entity' => $a->entity_type, 'at' => $a->created_at]), 'activityOverview' => $this->activityOverview($classroomIds)]);
    }

    public function teacher(Request $request): Response
    {
        $ids = $request->user()->teachingAssignments()->where('status', 'ACTIVE')->whereHas('classroom', fn ($q) => $q->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE'))->pluck('classroom_id');
        $stats = ['My Classes' => $ids->count(), 'My Students' => Enrollment::whereIn('classroom_id', $ids)->where('status', 'ACTIVE')->distinct('student_id')->count('student_id'), 'Active Assignments' => AssignmentDelivery::whereIn('classroom_id', $ids)->where('status', 'OPEN')->count(), 'Pending Grading' => Submission::whereHas('delivery', fn ($q) => $q->whereIn('classroom_id', $ids))->whereHas('answers', fn ($q) => $q->where('grading_status', 'NEEDS_REVIEW'))->count()];

        $upcoming = AssignmentDelivery::with('assignmentVersion.assignment', 'classroom')->whereHas('assignmentVersion.assignment')->whereIn('classroom_id', $ids)->whereIn('status', ['OPEN', 'SCHEDULED'])->whereNotNull('due_at')->orderBy('due_at')->limit(6)->get()->map(fn ($d) => ['title' => $d->assignmentVersion?->assignment?->title ?? 'Assignment', 'classroom' => $d->classroom?->name ?? 'Classroom', 'dueAt' => $d->due_at]);

        return Inertia::render('AppDashboard', ['title' => 'Teacher Dashboard', 'stats' => $stats, 'upcoming' => $upcoming, 'recent' => [], 'activityOverview' => $this->activityOverview($ids)]);
    }

    /**
     * Dashboard activity metrics scoped to the authorized classrooms.
     *
     * @param  Collection<int, int>  $classroomIds
     */
    private function activityOverview(Collection $classroomIds): array
    {
        $deliveryIds = AssignmentDelivery::query()
            ->whereIn('classroom_id', $classroomIds)
            ->whereIn('status', ['OPEN', 'SCHEDULED'])
            ->pluck('id');
        $deliveryClassroomIds = AssignmentDelivery::query()
            ->whereIn('id', $deliveryIds)
            ->pluck('classroom_id')
            ->unique()
            ->values();
        $assignedStudentIds = $deliveryClassroomIds->isEmpty()
            ? collect()
            : Enrollment::query()
                ->whereIn('classroom_id', $deliveryClassroomIds)
                ->where('status', 'ACTIVE')
                ->distinct('student_id')
                ->pluck('student_id');
        $assignedStudents = $assignedStudentIds->count();
        $completedStudents = $deliveryIds->isEmpty()
            ? 0
            : Submission::query()
                ->whereIn('assignment_delivery_id', $deliveryIds)
                ->whereIn('student_id', $assignedStudentIds)
                ->whereIn('status', ['SUBMITTED', 'LATE', 'GRADED', 'RETURNED'])
                ->distinct('student_id')
                ->count('student_id');
        $completionPercent = $assignedStudents > 0
            ? (int) round(min(100, ($completedStudents / $assignedStudents) * 100))
            : 0;

        $performance = Grade::query()
            ->join('submissions', 'submissions.id', '=', 'grades.submission_id')
            ->join('assignment_deliveries', 'assignment_deliveries.id', '=', 'submissions.assignment_delivery_id')
            ->join('assignment_versions', 'assignment_versions.id', '=', 'assignment_deliveries.assignment_version_id')
            ->join('classrooms', 'classrooms.id', '=', 'assignment_deliveries.classroom_id')
            ->whereIn('assignment_deliveries.classroom_id', $classroomIds)
            ->whereIn('grades.status', ['GRADED', 'RELEASED', 'RETURNED'])
            ->whereNotNull('grades.final_score')
            ->where('assignment_versions.total_points', '>', 0)
            ->select([
                'classrooms.id',
                'classrooms.name',
                DB::raw('ROUND(AVG((grades.final_score / assignment_versions.total_points) * 100), 1) as average_score'),
                DB::raw('COUNT(DISTINCT grades.id) as graded_count'),
            ])
            ->groupBy('classrooms.id', 'classrooms.name')
            ->orderByDesc('average_score')
            ->get()
            ->map(fn ($row): array => [
                'id' => (int) $row->id,
                'name' => (string) $row->name,
                'average' => (float) $row->average_score,
                'gradedCount' => (int) $row->graded_count,
            ])
            ->values();

        return [
            'completion' => [
                'completed' => $completedStudents,
                'total' => $assignedStudents,
                'remaining' => max(0, $assignedStudents - $completedStudents),
                'percent' => $completionPercent,
            ],
            'completionBreakdown' => [
                ['name' => 'Đã hoàn thành', 'value' => $completedStudents, 'color' => '#4f46e5'],
                ['name' => 'Chưa hoàn thành', 'value' => max(0, $assignedStudents - $completedStudents), 'color' => '#dbeafe'],
            ],
            'studentTrend' => [
                'week' => $this->studentTrend($classroomIds, 7),
                'month' => $this->studentTrend($classroomIds, 30),
            ],
            'classPerformance' => [
                'highest' => $performance->first(),
                'lowest' => $performance->sortBy('average')->first(),
                'all' => $performance->take(6)->values(),
            ],
        ];
    }

    /**
     * @param  Collection<int, int>  $classroomIds
     * @return array<int, array{label: string, newStudents: int, withdrawnStudents: int}>
     */
    private function studentTrend(Collection $classroomIds, int $days): array
    {
        $start = now()->startOfDay()->subDays($days - 1);
        $end = now()->endOfDay();
        $newStudents = Enrollment::query()
            ->whereIn('classroom_id', $classroomIds)
            ->whereBetween('enrolled_at', [$start, $end])
            ->selectRaw('DATE(enrolled_at) as trend_date, COUNT(DISTINCT student_id) as total')
            ->groupBy('trend_date')
            ->pluck('total', 'trend_date');
        $withdrawnStudents = Enrollment::query()
            ->whereIn('classroom_id', $classroomIds)
            ->whereNotNull('withdrawn_at')
            ->whereBetween('withdrawn_at', [$start, $end])
            ->selectRaw('DATE(withdrawn_at) as trend_date, COUNT(DISTINCT student_id) as total')
            ->groupBy('trend_date')
            ->pluck('total', 'trend_date');
        $trend = [];
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $key = $date->toDateString();
            $trend[] = [
                'label' => $days <= 7 ? $date->isoFormat('dd') : $date->format('d/m'),
                'newStudents' => (int) ($newStudents[$key] ?? 0),
                'withdrawnStudents' => (int) ($withdrawnStudents[$key] ?? 0),
            ];
        }

        return $trend;
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
                $completed = $statuses->contains(fn (string $status): bool => in_array($status, ['SUBMITTED', 'LATE', 'GRADED'], true));
                $active = $statuses->contains(fn (string $status): bool => in_array($status, ['IN_PROGRESS', 'RETURNED'], true));

                return ! $completed || $active;
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
