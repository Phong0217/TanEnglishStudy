<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Audit\AuditLogger;
use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClassroomRequest;
use App\Models\Classroom;
use App\Models\ClassroomTeacher;
use App\Models\CourseVersion;
use App\Models\Enrollment;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class ClassroomController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Admin/Classrooms/Index', ['classrooms' => Classroom::with('courseVersion.course', 'primaryTeacher')->withCount(['enrollments as student_count' => fn ($q) => $q->where('status', 'ACTIVE'), 'teacherAssignments as teacher_count' => fn ($q) => $q->where('status', 'ACTIVE')])->latest()->paginate(12), 'courseVersions' => CourseVersion::whereHas('course', fn ($q) => $q->where('center_id', $request->user()->center_id))->with('course')->get(['id', 'course_id', 'title', 'code']), 'teachers' => User::role('TEACHER')->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE')->get(['id', 'name'])]);
    }

    public function store(StoreClassroomRequest $request, AuditLogger $audit): RedirectResponse
    {
        $data = $request->validated();
        $version = CourseVersion::whereHas('course', fn ($q) => $q->where('center_id', $request->user()->center_id))->findOrFail($data['course_version_id']);
        $classroom = DB::transaction(function () use ($data, $request, $version) {
            $teacher = null;
            if (! empty($data['primary_teacher_id'])) {
                $teacher = User::role(RoleName::TEACHER->value)->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE')->findOrFail($data['primary_teacher_id']);
            }$classroom = Classroom::create([...collect($data)->except('primary_teacher_id')->all(), 'center_id' => $request->user()->center_id, 'course_version_id' => $version->id, 'primary_teacher_id' => $teacher?->id, 'status' => 'ACTIVE', 'created_by' => $request->user()->id]);
            if ($teacher) {
                ClassroomTeacher::create(['classroom_id' => $classroom->id, 'teacher_id' => $teacher->id, 'assignment_role' => 'TEACHER', 'status' => 'ACTIVE', 'assigned_by' => $request->user()->id, 'assigned_at' => now()]);
            }

            return $classroom;
        });
        $audit->record('CLASSROOM_CREATED', $classroom, null, $classroom->only(['name', 'code']));

        return back()->with('success', 'Classroom created successfully.');
    }

    public function assignTeacher(Request $request, Classroom $classroom, AuditLogger $audit): RedirectResponse
    {
        $this->authorize('update', $classroom);
        $data = $request->validate(['teacher_id' => ['required', 'integer'], 'assignment_role' => ['required', 'in:TEACHER,ASSISTANT'], 'primary' => ['required', 'boolean']]);
        $teacher = User::role('TEACHER')->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE')->findOrFail($data['teacher_id']);
        DB::transaction(function () use ($classroom, $teacher, $data, $request) {
            ClassroomTeacher::updateOrCreate(['classroom_id' => $classroom->id, 'teacher_id' => $teacher->id], ['assignment_role' => $data['assignment_role'], 'status' => 'ACTIVE', 'assigned_by' => $request->user()->id, 'assigned_at' => now(), 'ended_at' => null]);
            if ($data['primary']) {
                Classroom::whereKey($classroom->id)->lockForUpdate()->update(['primary_teacher_id' => $teacher->id]);
            }
        });
        $teacher->notify(new SystemNotification('Class assigned', 'You were assigned to '.$classroom->name, '/teacher/classes'));
        $audit->record('TEACHER_ASSIGNED', $classroom, null, ['teacher_id' => $teacher->id, 'primary' => $data['primary']]);

        return back()->with('success', 'Teacher assigned successfully.');
    }

    public function enroll(Request $request, Classroom $classroom, AuditLogger $audit): RedirectResponse
    {
        $this->authorize('update', $classroom);
        $data = $request->validate(['student_id' => ['required', 'integer']]);
        $student = User::role('STUDENT')->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE')->findOrFail($data['student_id']);
        $enrollment = Enrollment::updateOrCreate(['classroom_id' => $classroom->id, 'student_id' => $student->id], ['status' => 'ACTIVE', 'enrolled_at' => now(), 'completed_at' => null, 'withdrawn_at' => null, 'created_by' => $request->user()->id, 'updated_by' => $request->user()->id]);
        $student->notify(new SystemNotification('Class enrollment', 'You are enrolled in '.$classroom->name, '/student/classes'));
        $audit->record('STUDENT_ENROLLED', $enrollment, null, ['classroom_id' => $classroom->id, 'student_id' => $student->id]);

        return back()->with('success', 'Student enrolled successfully.');
    }
}
