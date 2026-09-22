<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
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
}
