<?php

namespace App\Http\Controllers;

use App\Domain\AI\AuthoringScope;
use App\Domain\Audit\AuditLogger;
use App\Domain\Learning\BlockSchemaValidator;
use App\Models\Question;
use App\Models\QuestionVersion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class QuestionController extends Controller
{
    public function index(Request $request): Response
    {
        abort_unless($request->user()->can('questions.manage'), 403);
        $query = app(AuthoringScope::class)->questions($request->user())->with(['versions' => fn ($q) => $q->latest('version_number')->limit(1), 'creator'])->withCount(['versions as usage_count' => fn ($q) => $q->whereHas('assignmentItems')]);
        if ($search = $request->string('search')->trim()->toString()) {
            $query->whereHas('versions', fn ($q) => $q->where('content_json', 'like', "%{$search}%"));
        }foreach (['type', 'skill', 'difficulty', 'status'] as $filter) {
            if ($value = $request->get($filter)) {
                $query->where($filter, $value);
            }
        }

        return Inertia::render('Questions/Index', ['questions' => $query->latest()->paginate(15)->withQueryString(), 'filters' => $request->only('search', 'type', 'skill', 'difficulty', 'status')]);
    }

    public function store(Request $request, BlockSchemaValidator $validator): RedirectResponse
    {
        abort_unless($request->user()->can('questions.manage'), 403);
        $data = $request->validate(['type' => ['required', 'in:multiple_choice,multiple_select,true_false,fill_blank,dropdown,matching,ordering,drag_drop,short_answer,open_response,reading_comprehension,listening_question'], 'skill' => ['required', 'in:READING,LISTENING,VOCABULARY,GRAMMAR,WRITING,SPEAKING,MIXED'], 'difficulty' => ['required', 'in:EASY,MEDIUM,HARD'], 'content' => ['required', 'array'], 'answer_key' => ['nullable', 'array'], 'settings' => ['nullable', 'array'], 'explanation' => ['nullable', 'string'], 'rubric' => ['nullable', 'array'], 'grading_mode' => ['required', 'in:AUTO,TEACHER,AI_ASSISTED']]);
        $validator->validate(['block_type' => $data['type'], 'content_json' => $data['content'], 'answer_key_json' => $data['answer_key'] ?? null, 'settings_json' => $data['settings'] ?? [], 'rubric' => $data['rubric'] ?? null, 'points' => 1, 'grading_mode' => $data['grading_mode']]);
        DB::transaction(function () use ($data, $request) {
            $question = Question::create(['center_id' => $request->user()->center_id, 'type' => $data['type'], 'skill' => $data['skill'], 'difficulty' => $data['difficulty'], 'status' => 'DRAFT', 'created_by' => $request->user()->id, 'content_hash' => hash('sha256', json_encode($data['content']))]);
            QuestionVersion::create(['question_id' => $question->id, 'version_number' => 1, 'content_json' => $data['content'], 'answer_key_json' => $data['answer_key'] ?? null, 'settings_json' => $data['settings'] ?? [], 'explanation' => $data['explanation'] ?? null, 'rubric' => $data['rubric'] ?? null, 'created_by' => $request->user()->id]);
        });

        return back()->with('success', 'Question created successfully.');
    }

    public function review(Request $request, Question $question, AuditLogger $audit): RedirectResponse
    {
        abort_unless($request->user()->can('questions.manage'), 403);
        $data = $request->validate(['status' => ['required', 'in:APPROVED,REJECTED'], 'reason' => ['nullable', 'required_if:status,REJECTED', 'string', 'max:1000']]);
        abort_unless(app(AuthoringScope::class)->questions($request->user())->whereKey($question->id)->exists(), 403);
        if ($request->user()->hasRole('TEACHER')) {
            abort_unless($question->created_by === $request->user()->id, 403);
        }$old = $question->status;
        $question->update(['status' => $data['status']]);
        $audit->record('QUESTION_'.$data['status'], $question, ['status' => $old], ['status' => $data['status']], $data['reason'] ?? null);

        return back()->with('success', 'Question review saved.');
    }
}
