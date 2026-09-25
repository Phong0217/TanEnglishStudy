<?php

namespace App\Http\Controllers;

use App\Enums\RoleName;
use App\Models\Lesson;
use App\Models\LessonSet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LessonSetController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'lesson_ids' => ['required', 'array', 'min:2'],
            'lesson_ids.*' => ['required', 'integer', 'distinct', 'exists:lessons,id'],
        ]);

        $actor = $request->user();
        $lessonIds = array_values(array_map('intval', $data['lesson_ids']));
        $lessons = Lesson::query()
            ->whereIn('id', $lessonIds)
            ->whereHas('creator', fn ($query) => $query->where('center_id', $actor->center_id))
            ->when($actor->hasRole(RoleName::TEACHER->value), fn ($query) => $query->where('created_by', $actor->id))
            ->get(['id']);

        if ($lessons->count() !== count($lessonIds)) {
            throw ValidationException::withMessages(['lesson_ids' => 'Một hoặc nhiều lesson không thuộc phạm vi bạn được phép quản lý.']);
        }

        $lessonSet = DB::transaction(function () use ($actor, $data, $lessonIds): LessonSet {
            $set = LessonSet::create(['center_id' => $actor->center_id, 'created_by' => $actor->id, 'title' => $data['title'], 'status' => 'DRAFT']);
            $set->items()->createMany(array_map(fn (int $lessonId, int $position): array => ['lesson_id' => $lessonId, 'position' => $position], $lessonIds, range(1, count($lessonIds))));
            return $set;
        });

        return back()->with('success', "Đã tạo tệp đề '{$lessonSet->title}' gồm ".count($lessonIds).' lesson.');
    }

    public function destroy(Request $request, LessonSet $lessonSet): RedirectResponse
    {
        abort_unless((int) $lessonSet->center_id === (int) $request->user()->center_id, 403);
        if ($request->user()->hasRole(RoleName::TEACHER->value)) {
            abort_unless((int) $lessonSet->created_by === (int) $request->user()->id, 403);
        }
        $lessonSet->delete();
        return back()->with('success', 'Đã xóa tệp đề. Các lesson gốc vẫn được giữ nguyên.');
    }
}
