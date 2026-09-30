<?php

namespace App\Http\Controllers;

use App\Enums\RoleName;
use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\ZaloGroupConnection;
use App\Models\ZaloSpeakingSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class ZaloChatbotController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $classrooms = $this->classrooms($user)->orderBy('name')->get(['id', 'name', 'code', 'status']);
        $lessons = $this->lessons($user)->whereIn('status', ['DRAFT', 'PUBLISHED'])->latest('updated_at')->get(['id', 'title', 'status']);
        $connections = ZaloGroupConnection::with(['classroom:id,name,code', 'activeLesson:id,title,status'])
            ->withCount('submissions')
            ->latest()
            ->get();
        $submissions = ZaloSpeakingSubmission::with(['connection.classroom:id,name,code', 'lesson:id,title'])
            ->latest('received_at')->paginate(25)->withQueryString();

        return Inertia::render('ZaloChatbot/Index', [
            'connections' => $connections,
            'classrooms' => $classrooms,
            'lessons' => $lessons,
            'submissions' => $submissions,
            'isAdmin' => $user->hasRole(RoleName::ADMIN->value),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'classroom_id' => ['required', 'integer'],
            'group_id' => ['required', 'string', 'max:191'],
            'group_name' => ['nullable', 'string', 'max:255'],
            'active_lesson_id' => ['nullable', 'integer'],
        ]);
        $classroom = $this->classrooms($request->user())->findOrFail($data['classroom_id']);
        $lesson = $this->resolveLesson($request->user(), $data['active_lesson_id'] ?? null);
        DB::transaction(function () use ($request, $data, $classroom, $lesson): void {
            ZaloGroupConnection::updateOrCreate(
                ['center_id' => $request->user()->center_id, 'classroom_id' => $classroom->id],
                [
                    'active_lesson_id' => $lesson?->id,
                    'group_id' => trim($data['group_id']),
                    'group_name' => filled($data['group_name'] ?? null) ? trim($data['group_name']) : null,
                    'status' => 'ACTIVE',
                    'connected_by' => $request->user()->id,
                ],
            );
        });

        return back()->with('success', 'Đã kết nối nhóm Zalo với lớp học.');
    }

    public function update(Request $request, ZaloGroupConnection $connection): RedirectResponse
    {
        $this->authorizeConnection($request, $connection);
        $data = $request->validate([
            'group_name' => ['nullable', 'string', 'max:255'],
            'active_lesson_id' => ['nullable', 'integer'],
            'status' => ['required', 'in:ACTIVE,INACTIVE'],
        ]);
        $lesson = $this->resolveLesson($request->user(), $data['active_lesson_id'] ?? null);
        $connection->update([
            'group_name' => filled($data['group_name'] ?? null) ? trim($data['group_name']) : null,
            'active_lesson_id' => $lesson?->id,
            'status' => $data['status'],
        ]);

        return back()->with('success', 'Đã cập nhật kết nối Zalo.');
    }

    public function destroy(Request $request, ZaloGroupConnection $connection): RedirectResponse
    {
        $this->authorizeConnection($request, $connection);
        $connection->update(['status' => 'INACTIVE', 'active_lesson_id' => null]);

        return back()->with('success', 'Đã ngắt kết nối nhóm Zalo.');
    }

    private function classrooms($user)
    {
        return Classroom::query()
            ->where('center_id', $user->center_id)
            ->where('status', 'ACTIVE')
            ->when($user->hasRole(RoleName::TEACHER->value), fn ($query) => $query->whereHas('teacherAssignments', fn ($teacher) => $teacher->where('teacher_id', $user->id)->where('status', 'ACTIVE')));
    }

    private function lessons($user)
    {
        return Lesson::query()->whereHas('creator', fn ($query) => $query->where('center_id', $user->center_id))
            ->whereHas('blocks', fn ($query) => $query->where('block_type', 'speaking_prompt'))
            ->when($user->hasRole(RoleName::TEACHER->value), fn ($query) => $query->where('created_by', $user->id));
    }

    private function resolveLesson($user, mixed $lessonId): ?Lesson
    {
        if ($lessonId === null || $lessonId === '') {
            return null;
        }

        return $this->lessons($user)->findOrFail((int) $lessonId);
    }

    private function authorizeConnection(Request $request, ZaloGroupConnection $connection): void
    {
        abort_unless($connection->center_id === $request->user()->center_id, 403);
        abort_unless($this->classrooms($request->user())->whereKey($connection->classroom_id)->exists(), 403);
    }
}
