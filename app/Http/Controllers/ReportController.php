<?php

namespace App\Http\Controllers;

use App\Models\AssignmentDelivery;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Submission;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public function index(Request $request): Response
    {
        abort_unless($request->user()->can('reports.view'), 403);
        $classrooms = Classroom::withCount(['enrollments as students' => fn ($q) => $q->where('status', 'ACTIVE'), 'deliveries'])->get();
        if ($request->user()->hasRole('TEACHER')) {
            $classrooms = $classrooms->filter(fn ($classroom) => $classroom->teacherAssignments()->where('teacher_id', $request->user()->id)->where('status', 'ACTIVE')->exists())->values();
        }$ids = $classrooms->pluck('id');
        $submissions = Submission::whereHas('delivery', fn ($q) => $q->whereIn('classroom_id', $ids));
        $released = Grade::where('status', 'RELEASED')->whereHas('submission.delivery', fn ($q) => $q->whereIn('classroom_id', $ids));

        return Inertia::render('Reports/Index', ['metrics' => ['Classrooms' => $classrooms->count(), 'Assignments' => AssignmentDelivery::whereIn('classroom_id', $ids)->count(), 'Submissions' => (clone $submissions)->count(), 'Late Submissions' => (clone $submissions)->where('status', 'LATE')->count(), 'Average Score' => round((float) $released->avg('final_score'), 2)], 'classrooms' => $classrooms]);
    }
}
