<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ClassroomViewerController extends Controller
{
    public function classes(Request $request): Response
    {
        $classes = Classroom::with('courseVersion.course', 'primaryTeacher')->withCount(['enrollments as student_count' => fn ($q) => $q->where('status', 'ACTIVE'), 'deliveries'])->whereHas('teacherAssignments', fn ($q) => $q->where('teacher_id', $request->user()->id)->where('status', 'ACTIVE'))->get();

        return Inertia::render('Teacher/Classes', ['classes' => $classes]);
    }

    public function students(Request $request): Response
    {
        $ids = $request->user()->teachingAssignments()->where('status', 'ACTIVE')->pluck('classroom_id');
        $students = User::role('STUDENT')->with('studentProfile')->whereHas('enrollments', fn ($q) => $q->whereIn('classroom_id', $ids)->where('status', 'ACTIVE'))->paginate(15);

        return Inertia::render('Teacher/Students', ['students' => $students]);
    }

    public function show(Request $request, Classroom $classroom): Response
    {
        $this->authorize('view', $classroom);

        $students = Enrollment::query()
            ->with(['student.studentProfile'])
            ->where('classroom_id', $classroom->id)
            ->where('status', 'ACTIVE')
            ->whereHas('student', fn ($query) => $query->role('STUDENT')->where('center_id', $classroom->center_id))
            ->orderBy('id')
            ->paginate(25)
            ->withQueryString();

        $students->setCollection($students->getCollection()->map(function (Enrollment $enrollment): array {
            $student = $enrollment->student;
            $status = $student?->status;

            return [
                'id' => $student?->id,
                'name' => $student?->name ?? 'Học sinh không xác định',
                'email' => $student?->email,
                'status' => $status instanceof \BackedEnum ? $status->value : (string) $status,
                'student_code' => $student?->studentProfile?->student_code,
                'enrolled_at' => $enrollment->enrolled_at?->toIso8601String(),
            ];
        }));

        return Inertia::render('Classrooms/Show', [
            'classroom' => $classroom->load(['courseVersion.course', 'primaryTeacher'])->only(['id', 'name', 'code', 'status', 'course_version_id', 'primary_teacher_id']),
            'course' => $classroom->courseVersion?->course?->only(['id', 'title']),
            'courseVersion' => $classroom->courseVersion?->only(['id', 'title']),
            'primaryTeacher' => $classroom->primaryTeacher?->only(['id', 'name']),
            'students' => $students,
            'backUrl' => $request->user()->hasRole('ADMIN') ? route('admin.classrooms.index') : route('teacher.classes.index'),
        ]);
    }
}
