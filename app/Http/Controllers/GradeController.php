<?php

namespace App\Http\Controllers;

use App\Domain\Assessment\GradeService;
use App\Http\Requests\Assessment\GradeSubmissionRequest;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GradeController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Submission::with('student', 'delivery.classroom', 'delivery.assignmentVersion.assignment.sourceLesson', 'grade')
            ->whereHas('delivery.classroom', fn ($q) => $q->where('center_id', $request->user()->center_id))
            // Soft-deleted assignments must never produce a broken gradebook row.
            ->whereHas('delivery.assignmentVersion.assignment');
        if ($request->user()->hasRole('TEACHER')) {
            $query->whereHas('delivery.classroom.teacherAssignments', fn ($q) => $q->where('teacher_id', $request->user()->id)->where('status', 'ACTIVE'));
        }

        if ($request->filled('classroom_id')) {
            $query->whereHas('delivery', fn ($q) => $q->where('classroom_id', (int) $request->integer('classroom_id')));
        }
        if ($request->filled('lesson_id')) {
            $query->whereHas('delivery.assignmentVersion.assignment', fn ($q) => $q->where('source_lesson_id', (int) $request->integer('lesson_id')));
        }

        $classrooms = Classroom::query()->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE');
        if ($request->user()->hasRole('TEACHER')) {
            $classrooms->whereHas('teacherAssignments', fn ($q) => $q->where('teacher_id', $request->user()->id)->where('status', 'ACTIVE'));
        }
        $classrooms = $classrooms->orderBy('name')->get(['id', 'name']);
        $lessons = Lesson::query()->where('status', 'PUBLISHED')
            ->whereHas('assignments.versions.deliveries.submissions', fn ($q) => $q->whereHas('delivery.classroom', fn ($class) => $class->where('center_id', $request->user()->center_id)))
            ->orderBy('title')->get(['id', 'title']);

        $filters = $request->only(['classroom_id', 'lesson_id']);
        if ($request->routeIs('*.gradebook.index')) {
            $groups = $query->get()->groupBy(fn ($submission) => implode(':', [
                $submission->delivery?->classroom_id ?? 0,
                $submission->delivery?->assignmentVersion?->assignment?->source_lesson_id ?? 0,
            ]))->map(function ($submissions) {
                $first = $submissions->first();
                $graded = $submissions->filter(fn ($submission) => $submission->grade !== null);
                return [
                    'classroom' => $first->delivery?->classroom?->name ?? 'Lớp không xác định',
                    'lesson' => $first->delivery?->assignmentVersion?->assignment?->sourceLesson?->title ?? $first->delivery?->assignmentVersion?->assignment?->title ?? 'Bài học không xác định',
                    'students' => $submissions->pluck('student_id')->unique()->count(),
                    'submitted' => $submissions->whereIn('status', ['SUBMITTED', 'LATE', 'GRADED'])->count(),
                    'graded' => $graded->count(),
                    'average_score' => $graded->count() ? round((float) $graded->avg(fn ($submission) => (float) $submission->grade->final_score), 2) : null,
                    'max_score' => $first->delivery?->assignmentVersion?->total_points,
                ];
            })->values();

            return Inertia::render('Grades/Gradebook', compact('groups', 'classrooms', 'lessons', 'filters'));
        }

        return Inertia::render('Grades/Index', [
            'submissions' => $query->latest()->paginate(15)->withQueryString(),
            'classrooms' => $classrooms,
            'lessons' => $lessons,
            'filters' => $filters,
        ]);
    }

    public function show(Request $request, Submission $submission): Response
    {
        $this->authorize('grade', $submission);
        $submission->load('student', 'delivery.classroom', 'delivery.assignmentVersion.assignment', 'answers.item', 'grade.audits');

        return Inertia::render('Grades/Show', ['submission' => $submission]);
    }

    public function update(GradeSubmissionRequest $request, Submission $submission, GradeService $service): RedirectResponse
    {
        $service->grade($request->user(), $submission, $request->validated('scores'), $request->validated('feedback'), $request->validated('reason'));

        return back()->with('success', 'Grade saved successfully.');
    }

    public function release(Request $request, Grade $grade, GradeService $service): RedirectResponse
    {
        $submission = $grade->submission;
        $this->authorize('grade', $submission);
        $service->release($request->user(), $grade);

        return back()->with('success', 'Grade released to the student.');
    }
}
