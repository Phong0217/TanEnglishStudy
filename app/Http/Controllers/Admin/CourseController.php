<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Audit\AuditLogger;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Course::withCount('versions');
        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(fn ($q) => $q->where('title', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%"));
        }

        return Inertia::render('Admin/Courses/Index', ['courses' => $query->latest()->paginate(12)->withQueryString()]);
    }

    public function store(StoreCourseRequest $request, AuditLogger $audit): RedirectResponse
    {
        $course = Course::create([...$request->safe()->only(['code', 'title', 'description', 'grade_level', 'cefr_level']), 'center_id' => $request->user()->center_id, 'status' => 'DRAFT', 'created_by' => $request->user()->id]);
        $audit->record('COURSE_CREATED', $course, null, $course->only(['code', 'title', 'status']));

        return back()->with('success', 'Course created successfully.');
    }
}
