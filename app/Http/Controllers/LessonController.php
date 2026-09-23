<?php

namespace App\Http\Controllers;

use App\Domain\Audit\AuditLogger;
use App\Domain\Assessment\AssignLessonAction;
use App\Domain\Learning\BlockSchemaNormalizer;
use App\Domain\Learning\BlockSchemaValidator;
use App\Enums\RoleName;
use App\Http\Requests\Learning\SaveLessonRequest;
use App\Http\Requests\Assessment\AssignLessonRequest;
use App\Models\Lesson;
use App\Models\LessonBlock;
use App\Models\LessonVersion;
use App\Models\User;
use App\Support\Logging\AppLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class LessonController extends Controller
{
    public function index(Request $request): Response
    {
        $isAdmin = $request->user()->hasRole(RoleName::ADMIN->value);
        $query = Lesson::with(['unit', 'creator:id,name,email'])->withCount('blocks')->whereHas('creator', fn ($q) => $q->where('center_id', $request->user()->center_id));
        if (! $isAdmin) {
            $query->where('created_by', $request->user()->id);
        } else {
            if ($request->filled('teacher_id')) {
                $query->where('created_by', (int) $request->input('teacher_id'));
            }
            if ($request->filled('classroom_id')) {
                $classroomId = (int) $request->input('classroom_id');
                $query->whereHas('assignments.versions.deliveries', fn ($q) => $q->where('classroom_id', $classroomId));
            }
            if ($request->filled('date')) {
                $query->whereDate('lessons.created_at', $request->input('date'));
            }
        }

        $teachers = $isAdmin ? User::role(RoleName::TEACHER->value)->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE')->orderBy('name')->get(['id', 'name']) : collect();
        $classrooms = $isAdmin ? \App\Models\Classroom::where('center_id', $request->user()->center_id)->where('status', 'ACTIVE')->orderBy('name')->get(['id', 'name', 'code']) : collect();
        $filters = $request->only(['teacher_id', 'classroom_id', 'date']);

        return Inertia::render('Lessons/Index', [
            'lessons' => $query->latest('lessons.created_at')->paginate(15)->withQueryString()->through(fn ($lesson) => ['id' => $lesson->id, 'title' => $lesson->title, 'status' => $lesson->status->value, 'unit' => $lesson->unit?->title, 'course' => null, 'blocksCount' => $lesson->blocks_count, 'createdAt' => $lesson->created_at?->toISOString(), 'createdBy' => $lesson->creator?->name, 'canEdit' => $request->user()->can('update', $lesson)]),
            'units' => [],
            'teachers' => $teachers,
            'classrooms' => $classrooms,
            'filters' => $filters,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['title' => ['required', 'string', 'max:255']]);
        $lesson = DB::transaction(function () use ($data, $request) {
            $position = (int) Lesson::where('created_by', $request->user()->id)->lockForUpdate()->max('position') + 1;
            $lesson = Lesson::create(['unit_id' => null, 'title' => $data['title'], 'position' => $position, 'status' => 'DRAFT', 'lock_version' => 1, 'created_by' => $request->user()->id]);
            $lesson->versions()->create([
                'version_number' => 1,
                'title_snapshot' => $lesson->title,
                'description_snapshot' => $lesson->description,
                'instructions_snapshot' => $lesson->instructions,
                'learning_objectives_json' => $lesson->learning_objectives_json,
                'status' => 'DRAFT',
                'lock_version' => 1,
                'created_by' => $request->user()->id,
            ]);

            return $lesson;
        });

        return redirect()->route($request->user()->hasRole('ADMIN') ? 'admin.lessons.builder' : 'teacher.lessons.builder', $lesson)->with('success', 'Lesson created.');
    }

    public function builder(Request $request, Lesson $lesson, AppLogger $logger): Response
    {
        $this->authorize('update', $lesson);
        if ($request->boolean('preview')) {
            return $this->preview($request, $lesson);
        }
        $lesson->load('blocks', 'versions.blocks', 'publishedVersion.blocks');
        $draft = $this->draftVersion($lesson);
        $draft->load('blocks');
        $lesson->setRelation('blocks', $draft->blocks);
        $logger->debug(\App\Enums\LogService::LESSON_BUILDER, 'Builder content resolved', [
            'lesson_id' => $lesson->id,
            'draft_version_id' => $draft->id,
            'draft_block_count' => $draft->blocks->count(),
            'published_version_id' => $lesson->published_version_id,
            'published_block_count' => $lesson->publishedVersion?->blocks()->count() ?? 0,
        ]);

        $classrooms = \App\Models\Classroom::withCount(['enrollments as student_count' => fn ($q) => $q->where('status', 'ACTIVE')])
            ->where('center_id', $request->user()->center_id)->where('status', 'ACTIVE')
            ->when($request->user()->hasRole(RoleName::TEACHER->value), fn ($q) => $q->whereHas('teacherAssignments', fn ($t) => $t->where('teacher_id', $request->user()->id)->where('status', 'ACTIVE')))
            ->orderBy('name')->get(['id', 'name', 'code']);

        $skillOutline = $lesson->blocks
            ->groupBy(fn ($block) => $this->blockSkill($block->block_type->value, $block->settings_json ?? []))
            ->map(fn ($blocks, $skill) => ['id' => crc32($skill), 'title' => 'Kỹ năng '.$skill, 'lessons' => $blocks->values()->map(fn ($block, $index) => ['id' => $block->id ?? $index, 'title' => ucfirst(str_replace('_', ' ', $block->block_type->value)), 'position' => $block->position])])
            ->values();

        return Inertia::render('Lessons/Builder', ['lesson' => $this->serializeForAuthor($lesson), 'outline' => $skillOutline, 'classrooms' => $classrooms]);
    }

    public function assign(AssignLessonRequest $request, Lesson $lesson, AssignLessonAction $action, \App\Support\Logging\AppLogger $logger): RedirectResponse
    {
        $this->authorize('update', $lesson);
        $deliveries = $action->execute($request->user(), $lesson, $request->validated());
        // Re-resolve the authoring draft before returning to Builder. Assigning
        // snapshots the published version only; it must never leave the
        // authoring screen with an empty/stale block collection.
        $lesson->load('versions.blocks', 'publishedVersion.blocks');
        $draft = $this->draftVersion($lesson);
        $logger->info(\App\Enums\LogService::ASSIGNMENT, 'Lesson assigned', [
            'lesson_id' => $lesson->id,
            'delivery_count' => $deliveries->count(),
            'classroom_ids' => $deliveries->pluck('classroom_id')->values()->all(),
            'published_version_id' => $lesson->published_version_id,
            'published_block_count' => $lesson->publishedVersion?->blocks()->count() ?? 0,
            'draft_version_id' => $draft->id,
            'draft_block_count' => $draft->blocks()->count(),
        ]);

        $route = $request->user()->hasRole('ADMIN') ? 'admin.lessons.builder' : 'teacher.lessons.builder';

        return redirect()->route($route, $lesson)->with('success', 'Lesson assigned successfully.');
    }

    public function save(SaveLessonRequest $request, Lesson $lesson, AppLogger $logger): JsonResponse
    {
        $data = $request->validated();
        $logger->debug(\App\Enums\LogService::LESSON_BUILDER, 'Lesson save started', ['lesson_id' => $lesson->id, 'lock_version' => $data['lock_version'], 'block_count' => count($data['blocks']), 'block_types' => collect($data['blocks'])->pluck('block_type')->values()->all()]);
        // Never allow an accidental empty/stale client payload to delete a
        // lesson that already contains blocks. An empty draft is valid only
        // before the first block is created.
        if (count($data['blocks']) === 0 && $this->draftVersion($lesson)->blocks()->exists()) {
            $logger->warning(\App\Enums\LogService::LESSON_BUILDER, 'Rejected empty lesson payload', ['lesson_id' => $lesson->id, 'lock_version' => $data['lock_version']]);
            return response()->json(['success' => false, 'message' => 'Không thể lưu dữ liệu rỗng vì Lesson hiện đã có block. Hãy tải lại trang để đồng bộ dữ liệu trước khi tiếp tục.'], 422);
        }
        try {
            $saved = DB::transaction(function () use ($lesson, $data, $request) {
            $current = Lesson::lockForUpdate()->findOrFail($lesson->id);
            if ($current->lock_version !== $data['lock_version']) {
                return null;
            }$current->update(['title' => $data['title'], 'description' => $data['description'] ?? null, 'instructions' => $data['instructions'] ?? null, 'estimated_duration_minutes' => $data['estimated_duration_minutes'] ?? null, 'updated_by' => $request->user()->id, 'lock_version' => $current->lock_version + 1]);
            $version = $this->draftVersion($current);
            $version->update(['title_snapshot' => $current->title, 'description_snapshot' => $current->description, 'instructions_snapshot' => $current->instructions, 'learning_objectives_json' => $current->learning_objectives_json, 'lock_version' => $version->lock_version + 1]);
            $keep = [];
            // Lesson blocks use soft deletes. A deleted block still participates
            // in MySQL unique indexes, so never reuse a position occupied by an
            // old (or another draft-version) row. Retained block ids are allowed
            // to move with the current ordering.
            $retainedIds = collect($data['blocks'])->pluck('id')->filter()->values();
            $occupiedPositions = LessonBlock::withTrashed()
                ->where('lesson_id', $current->id)
                ->when($retainedIds->isNotEmpty(), fn ($q) => $q->whereNotIn('id', $retainedIds->all()))
                ->pluck('position')
                ->map(fn ($position) => (int) $position)
                ->all();
            $positionBase = $version->id * 100000;
            while (collect($data['blocks'])->keys()->map(fn ($index) => $positionBase + $index + 1)->intersect($occupiedPositions)->isNotEmpty()) {
                $positionBase += 100000;
            }

            // MySQL checks the unique (lesson_version_id, position) index on
            // every update. When a teacher reorders blocks, writing the final
            // positions one by one can collide with another block that still
            // owns that position. Move all retained rows to a guaranteed-free
            // temporary range first, then write the requested final order.
            $temporaryBase = max($positionBase, max($occupiedPositions ?: [0])) + 100000;
            $retainedBlocks = $version->blocks()->whereIn('id', $retainedIds->all())->get();
            foreach ($retainedBlocks as $retainedBlock) {
                $retainedBlock->update(['position' => $temporaryBase + $retainedBlock->id]);
            }

            foreach ($data['blocks'] as $position => $input) {
                $content = $input['content_json'];
                if (isset($content['html'])) {
                    $content['html'] = $this->sanitizeHtml($content['html']);
                }$settings = array_merge((array) ($input['settings_json'] ?? []), ['skill' => $this->blockSkill($input['block_type'], (array) ($input['settings_json'] ?? []))]);
                $values = ['block_type' => $input['block_type'], 'content_json' => $content, 'answer_key_json' => $input['answer_key_json'] ?? null, 'settings_json' => $settings, 'points' => $input['points'], 'position' => $positionBase + $position + 1, 'required' => $input['required'], 'grading_mode' => $input['grading_mode']];
                if (! empty($input['id'])) {
                    $block = $version->blocks()->findOrFail($input['id']);
                    $block->update($values);
                } else {
                    $block = $version->blocks()->create(array_merge($values, ['lesson_id' => $current->id]));
                }$keep[] = $block->id;
            }$version->blocks()->whereNotIn('id', $keep)->delete();

            $current->setRelation('blocks', $version->blocks()->get());

            return $current;
            });
        } catch (Throwable $exception) {
            $logger->error(\App\Enums\LogService::LESSON_BUILDER, 'Lesson save failed', ['lesson_id' => $lesson->id, 'exception_class' => $exception::class]);
            throw $exception;
        }
        if (! $saved) {
            $logger->warning(\App\Enums\LogService::LESSON_BUILDER, 'Lesson save conflict', ['lesson_id' => $lesson->id, 'lock_version' => $data['lock_version']]);
            $lesson->load('versions.blocks');
            $draft = $this->draftVersion($lesson);
            $lesson->setRelation('blocks', $draft->blocks);

            return response()->json(['success' => false, 'message' => 'This lesson was changed in another session.', 'data' => ['server' => $this->serializeForAuthor($lesson)]], 409);
        }

        $logger->info(\App\Enums\LogService::LESSON, 'Lesson saved', ['lesson_id' => $saved->id, 'draft_version_id' => $saved->versions()->where('status', 'DRAFT')->value('id'), 'block_count' => count($data['blocks'])]);
        return response()->json(['success' => true, 'message' => 'Lesson saved successfully.', 'data' => $this->serializeForAuthor($saved)]);
    }

    public function destroy(Request $request, Lesson $lesson): RedirectResponse
    {
        $this->authorize('delete', $lesson);

        DB::transaction(function () use ($lesson) {
            $assignmentIds = DB::table('assignments')
                ->where('source_lesson_id', $lesson->id)
                ->lockForUpdate()
                ->pluck('id');

            if ($assignmentIds->isNotEmpty()) {
                $versionIds = DB::table('assignment_versions')
                    ->whereIn('assignment_id', $assignmentIds)
                    ->pluck('id');
                $itemIds = DB::table('assignment_items')
                    ->whereIn('assignment_version_id', $versionIds)
                    ->pluck('id');
                $deliveryIds = DB::table('assignment_deliveries')
                    ->whereIn('assignment_version_id', $versionIds)
                    ->pluck('id');
                $submissionIds = DB::table('submissions')
                    ->whereIn('assignment_delivery_id', $deliveryIds)
                    ->pluck('id');
                $gradeIds = DB::table('grades')->whereIn('submission_id', $submissionIds)->pluck('id');

                DB::table('grade_audits')->whereIn('grade_id', $gradeIds)->delete();
                DB::table('grade_audits')->whereIn('submission_id', $submissionIds)->delete();
                DB::table('grades')->whereIn('submission_id', $submissionIds)->delete();
                DB::table('submission_answers')->whereIn('submission_id', $submissionIds)->delete();
                DB::table('submissions')->whereIn('id', $submissionIds)->delete();
                DB::table('assignment_deliveries')->whereIn('id', $deliveryIds)->delete();
                DB::table('assignment_items')->whereIn('id', $itemIds)->delete();
                DB::table('assignment_versions')->whereIn('id', $versionIds)->delete();
                DB::table('assignments')->whereIn('id', $assignmentIds)->delete();
            }

            DB::table('lesson_progress')->where('lesson_id', $lesson->id)->delete();
            DB::table('lesson_blocks')->where('lesson_id', $lesson->id)->delete();
            DB::table('lesson_versions')->where('lesson_id', $lesson->id)->delete();
            $lesson->forceDelete();
        });

        return redirect()->route($request->user()->hasRole('ADMIN') ? 'admin.lessons.index' : 'teacher.lessons.index')
            ->with('success', 'Lesson and all related student learning data were permanently deleted.');
    }

    public function publish(Request $request, Lesson $lesson, BlockSchemaValidator $validator, BlockSchemaNormalizer $normalizer, AuditLogger $audit, AppLogger $logger): RedirectResponse
    {
        $this->authorize('publish', $lesson);
        $lesson->load('versions.blocks');
        $version = $this->draftVersion($lesson);
        $lesson->setRelation('blocks', $version->blocks);
        if ($lesson->blocks->isEmpty()) {
            throw ValidationException::withMessages(['lesson' => 'Add at least one valid block before publishing.']);
        }foreach ($lesson->blocks as $block) {
            // Repair only missing/duplicate IDs from older nested payloads
            // before strict validation. Existing valid IDs and content remain
            // unchanged, so answer-key references stay stable.
            $normalized = $normalizer->normalizeBlock($block->toArray());
            if (($normalized['content_json'] ?? []) !== ($block->content_json ?? [])) {
                $block->update(['content_json' => $normalized['content_json']]);
            }
            $validator->validate($normalized);
        }DB::transaction(function () use ($lesson, $version, $request) {
            $version->update(['status' => 'PUBLISHED', 'published_at' => now()]);
            $lesson->update(['status' => 'PUBLISHED', 'published_version_id' => $version->id, 'published_at' => now(), 'updated_by' => $request->user()->id]);
        });
        $logger->info(\App\Enums\LogService::LESSON, 'Lesson published', [
            'lesson_id' => $lesson->id,
            'published_version_id' => $version->id,
            'published_block_count' => $version->blocks()->count(),
        ]);
        $audit->record('LESSON_PUBLISHED', $lesson, null, ['status' => 'PUBLISHED']);

        return back()->with('success', 'Lesson published successfully.');
    }

    public function player(Request $request, Lesson $lesson): Response|RedirectResponse
    {
        $this->authorize('view', $lesson);
        // Published lessons that were assigned to the student's active class
        // are delivered through the existing immutable Assignment snapshot.
        // Redirecting here keeps one canonical attempt/submission flow.
        if ($request->user()->hasRole(RoleName::STUDENT->value) && $lesson->published_version_id) {
            $delivery = \App\Models\AssignmentDelivery::whereHas('assignmentVersion', fn ($q) => $q->where('source_lesson_version_id', $lesson->published_version_id))
                ->whereHas('classroom.enrollments', fn ($q) => $q->where('student_id', $request->user()->id)->where('status', 'ACTIVE'))
                ->whereIn('status', ['OPEN', 'SCHEDULED'])->orderByDesc('id')->first();
            if ($delivery) {
                return redirect()->route('student.assignments.show', $delivery);
            }
        }
        $lesson->load('publishedVersion.blocks:id,lesson_id,lesson_version_id,block_type,content_json,settings_json,points,position,required,grading_mode');
        $lesson->setRelation('blocks', $lesson->publishedVersion?->blocks ?? collect());

        return Inertia::render('Student/LessonPlayer', ['lesson' => ['id' => $lesson->id, 'title' => $lesson->title, 'description' => $lesson->description, 'blocks' => $lesson->blocks]]);
    }

    public function preview(Request $request, Lesson $lesson): Response
    {
        $this->authorize('update', $lesson);
        $lesson->load('versions.blocks');
        $version = $this->draftVersion($lesson);

        return Inertia::render('Student/LessonPlayer', [
            'lesson' => ['id' => $lesson->id, 'title' => $version->title_snapshot ?: $lesson->title, 'description' => $version->description_snapshot ?: $lesson->description, 'blocks' => $version->blocks],
            'preview' => true,
        ]);
    }

    private function serializeForAuthor(Lesson $lesson): array
    {
        return ['id' => $lesson->id, 'title' => $lesson->title, 'description' => $lesson->description, 'instructions' => $lesson->instructions, 'estimated_duration_minutes' => $lesson->estimated_duration_minutes, 'status' => $lesson->status->value, 'lock_version' => $lesson->lock_version, 'blocks' => $lesson->blocks->map(fn ($b) => ['id' => $b->id, 'block_type' => $b->block_type->value, 'content_json' => $b->content_json, 'answer_key_json' => $b->answer_key_json, 'settings_json' => $b->settings_json, 'skill' => $this->blockSkill($b->block_type->value, $b->settings_json ?? []), 'points' => (float) $b->points, 'position' => $b->position, 'required' => $b->required, 'grading_mode' => $b->grading_mode->value])];
    }

    private function blockSkill(string $type, array $settings = []): string
    {
        $selected = strtoupper((string) ($settings['skill'] ?? ''));
        if (in_array($selected, ['READING', 'SPEAKING', 'LISTENING', 'WRITING'], true)) {
            return $selected;
        }

        return match ($type) {
            'reading_passage', 'reading_comprehension' => 'READING',
            'listening_question', 'audio' => 'LISTENING',
            'open_response' => 'WRITING',
            'speaking_prompt' => 'SPEAKING',
            default => 'MIXED',
        };
    }

    private function sanitizeHtml(string $html): string
    {
        return strip_tags($html, '<p><br><strong><em><u><s><ul><ol><li><blockquote><h2><h3><a>');
    }

    private function draftVersion(Lesson $lesson): LessonVersion
    {
        $draft = $lesson->relationLoaded('versions') ? $lesson->versions->firstWhere('status', 'DRAFT') : $lesson->versions()->where('status', 'DRAFT')->first();
        if ($draft) {
            // Older local records may contain blocks created before lesson
            // versioning was enabled (lesson_version_id is NULL). Always adopt
            // every unversioned block into the draft; only checking whether the
            // draft has blocks would silently hide the remaining legacy blocks
            // after a reload/restart.
            LessonBlock::where('lesson_id', $lesson->id)
                ->whereNull('lesson_version_id')
                ->update(['lesson_version_id' => $draft->id]);

            // Some lessons were published by older code with an empty draft
            // version left behind. Rehydrate that draft from the immutable
            // published version instead of showing an empty Builder after a
            // reload/restart.
            $draft->load('blocks');
            if ($draft->blocks->isEmpty()) {
                $source = $this->publishedSourceVersion($lesson);
                if ($source) {
                    foreach ($source->blocks as $sourceBlock) {
                        $draft->blocks()->create([
                            'lesson_id' => $lesson->id,
                            'question_version_id' => $sourceBlock->question_version_id,
                            'block_type' => $sourceBlock->block_type->value,
                            'content_json' => $sourceBlock->content_json,
                            'answer_key_json' => $sourceBlock->answer_key_json,
                            'settings_json' => $sourceBlock->settings_json,
                            'schema_version' => $sourceBlock->schema_version,
                            'points' => $sourceBlock->points,
                            'position' => $sourceBlock->position,
                            'required' => $sourceBlock->required,
                            'grading_mode' => $sourceBlock->grading_mode->value,
                        ]);
                    }

                    // The relation was loaded before cloning and therefore
                    // still contains the old empty collection. Refresh it so
                    // Builder/serializeForAuthor never sends an empty block
                    // list after Publish -> Assign.
                    $draft->load('blocks');
                }
            }

            return $draft;
        }

        $source = $this->publishedSourceVersion($lesson);
        $draft = $lesson->versions()->create([
            'version_number' => ((int) $lesson->versions()->max('version_number')) + 1,
            'title_snapshot' => $lesson->title,
            'description_snapshot' => $lesson->description,
            'instructions_snapshot' => $lesson->instructions,
            'learning_objectives_json' => $lesson->learning_objectives_json,
            'status' => 'DRAFT',
            'created_by' => $lesson->updated_by ?: $lesson->created_by,
        ]);

        // A new draft must start from the last published version. Otherwise
        // opening Builder after a restart would show an empty lesson while
        // student assignment snapshots still contained the old content.
        if ($source) {
            foreach ($source->blocks as $sourceBlock) {
                $draft->blocks()->create([
                    'lesson_id' => $lesson->id,
                    'question_version_id' => $sourceBlock->question_version_id,
                    'block_type' => $sourceBlock->block_type->value,
                    'content_json' => $sourceBlock->content_json,
                    'answer_key_json' => $sourceBlock->answer_key_json,
                    'settings_json' => $sourceBlock->settings_json,
                    'schema_version' => $sourceBlock->schema_version,
                    'points' => $sourceBlock->points,
                    'position' => $sourceBlock->position,
                    'required' => $sourceBlock->required,
                    'grading_mode' => $sourceBlock->grading_mode->value,
                ]);
            }
            $draft->load('blocks');
        } else {
            LessonBlock::where('lesson_id', $lesson->id)
                ->whereNull('lesson_version_id')
                ->update(['lesson_version_id' => $draft->id]);
        }

        return $draft;
    }

    private function publishedSourceVersion(Lesson $lesson): ?LessonVersion
    {
        if ($lesson->published_version_id) {
            $source = LessonVersion::with('blocks')
                ->where('lesson_id', $lesson->id)
                ->where('status', 'PUBLISHED')
                ->find($lesson->published_version_id);

            if ($source && $source->blocks->isNotEmpty()) {
                return $source;
            }
        }

        $source = $lesson->versions()
            ->where('status', 'PUBLISHED')
            ->whereHas('blocks')
            ->with('blocks')
            ->latest('version_number')
            ->first();

        if ($source) {
            return $source;
        }

        // Repair legacy rows where blocks were linked to a different version
        // before published_version_id/lesson_version_id were introduced.
        return $lesson->versions()
            ->whereHas('blocks')
            ->with('blocks')
            ->latest('version_number')
            ->first();
    }
}
