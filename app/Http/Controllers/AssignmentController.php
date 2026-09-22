<?php

namespace App\Http\Controllers;

use App\Domain\AI\AuthoringScope;
use App\Domain\Assessment\CreateAssignmentAction;
use App\Domain\Assessment\DeliverAssignmentAction;
use App\Enums\RoleName;
use App\Enums\LogService;
use App\Http\Requests\Assessment\DeliverAssignmentRequest;
use App\Http\Requests\Assessment\StoreAssignmentRequest;
use App\Models\Assignment;
use App\Models\AssignmentVersion;
use App\Models\Classroom;
use App\Models\LessonBlock;
use App\Models\QuestionVersion;
use App\Support\Logging\AppLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class AssignmentController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Assignment::with(['versions' => fn ($q) => $q->withCount(['items', 'deliveries'])->latest('version_number')])->where('center_id', $request->user()->center_id);
        if ($request->user()->hasRole(RoleName::TEACHER->value)) {
            $query->where('created_by', $request->user()->id);
        }

        return Inertia::render('Assignments/Index', ['assignments' => $query->latest()->paginate(15), 'questions' => QuestionVersion::with('question')->whereIn('question_id', app(AuthoringScope::class)->questions($request->user())->where('status', 'APPROVED')->select('id'))->latest()->limit(100)->get(), 'lessonBlocks' => LessonBlock::with('lesson.unit.courseVersion.course')->whereHas('lesson.unit.courseVersion.course', fn ($q) => $q->where('center_id', $request->user()->center_id))->where('points', '>', 0)->limit(100)->get(), 'classrooms' => $this->allowedClassrooms($request)]);
    }

    public function store(StoreAssignmentRequest $request, CreateAssignmentAction $action, AppLogger $logger): RedirectResponse
    {
        $assignment = $action->execute($request->user(), $request->validated());
        $logger->info(LogService::ASSIGNMENT, 'Assignment created', ['assignment_id' => $assignment->id]);

        return back()->with('success', 'Assignment created with an immutable draft snapshot.');
    }

    public function deliver(DeliverAssignmentRequest $request, $version, DeliverAssignmentAction $action, AppLogger $logger): RedirectResponse
    {
        // Resolve explicitly instead of relying on implicit binding. This keeps
        // delivery reliable when route caches were built before this endpoint
        // existed, while preserving the public URL and request contract.
        $assignmentVersion = AssignmentVersion::with('assignment')->findOrFail((int) $version);
        $classroom = $this->allowedClassrooms($request)->firstWhere('id', (int) $request->validated('classroom_id'));
        abort_unless($classroom, 403);
        $action->execute($request->user(), $assignmentVersion, $classroom, $request->validated());
        $logger->info(LogService::ASSIGNMENT, 'Assignment delivered', ['assignment_id' => $assignmentVersion->assignment_id, 'assignment_version_id' => $assignmentVersion->id, 'classroom_id' => $classroom->id]);

        return back()->with('success', 'Assignment delivered successfully.');
    }

    public function destroy(Request $request, Assignment $assignment, AppLogger $logger): RedirectResponse
    {
        $this->authorize('delete', $assignment);

        DB::transaction(function () use ($assignment, $request) {
            // Soft-delete the aggregate only. Deliveries, submissions and grades
            // remain intact for audit/history and are hidden from active lists.
            $assignment->update(['status' => 'ARCHIVED', 'updated_by' => $request->user()->id]);
            $assignment->delete();
        });

        $logger->info(LogService::ASSIGNMENT, 'Assignment archived', ['assignment_id' => $assignment->id]);

        return back()->with('success', 'Assignment deleted successfully.');
    }

    private function allowedClassrooms(Request $request)
    {
        $query = Classroom::where('center_id', $request->user()->center_id)->where('status', 'ACTIVE');
        if ($request->user()->hasRole(RoleName::TEACHER->value)) {
            $query->whereHas('teacherAssignments', fn ($q) => $q->where('teacher_id', $request->user()->id)->where('status', 'ACTIVE'));
        }

        return $query->get(['id', 'name', 'code']);
    }
}
