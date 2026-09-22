<?php

namespace App\Http\Controllers;

use App\Domain\AI\AuthoringScope;
use App\Domain\AI\EnglishQuestionValidator;
use App\Domain\Audit\AuditLogger;
use App\Jobs\GenerateQuestionsJob;
use App\Models\AiGenerationJob;
use App\Models\Question;
use App\Models\QuestionSource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnglishQuestionReviewController extends Controller
{
    public function update(Request $request, Question $question, AuthoringScope $scope, EnglishQuestionValidator $validator, AuditLogger $audit): RedirectResponse
    {
        $this->authorizeQuestion($request, $question, $scope);
        $data = $request->validate(['expected_version' => 'required|integer', 'content' => 'required|array', 'answerKey' => 'required|array', 'explanation' => 'required|string', 'difficulty' => 'required|string', 'english_category' => 'required|string', 'concept' => 'required|string|max:255']);
        abort_unless(isset(config('english-ai.categories')[$data['english_category']]) && isset(config('english-ai.difficulties')[$data['difficulty']]), 422);
        DB::transaction(function () use ($question, $request, $data, $validator, $audit) {
            $question = Question::lockForUpdate()->findOrFail($question->id);
            $latest = $question->versions()->with('sources.documentChunk')->firstOrFail();
            abort_unless($latest->id === $data['expected_version'], 409);
            $sources = $latest->sources->map(fn ($s) => ['id' => $s->document_chunk_id, 'content' => $s->documentChunk->content, 'page_number' => $s->page_number])->all();
            $output = $validator->validate(array_merge($data, ['type' => $question->type->value, 'sources' => $latest->sources->map(fn ($s) => ['chunkId' => $s->document_chunk_id, 'sourceExcerpt' => $s->source_excerpt])->all()]), ['type' => $question->type->value, 'difficulty' => $data['difficulty'], 'category' => $data['english_category']], $sources);
            $version = $question->versions()->create(['version_number' => $latest->version_number + 1, 'content_json' => $output['content'], 'answer_key_json' => $output['answerKey'], 'settings_json' => array_merge($latest->settings_json ?? [], ['english_category' => $data['english_category'], 'concept' => $data['concept'], 'difficulty' => $data['difficulty']]), 'explanation' => $output['explanation'], 'created_by' => $request->user()->id]);
            foreach ($latest->sources as $source) {
                QuestionSource::create(['question_version_id' => $version->id, 'document_chunk_id' => $source->document_chunk_id, 'page_number' => $source->page_number, 'source_excerpt' => $source->source_excerpt]);
            }
            $question->update(['status' => 'IN_REVIEW', 'difficulty' => $data['difficulty'], 'english_category' => $data['english_category'], 'concept' => $data['concept'], 'content_hash' => hash('sha256', $validator->normalize($data['content']['prompt']))]);
            $audit->record('AI_QUESTION_EDITED', $question, ['version_id' => $latest->id], ['version_id' => $version->id]);
        });

        return back()->with('success', 'New revision saved. Review it before approving.');
    }

    public function bulk(Request $request, AuthoringScope $scope, AuditLogger $audit): RedirectResponse
    {
        $data = $request->validate(['ids' => 'required|array|min:1|max:60', 'ids.*' => 'integer|distinct', 'action' => 'required|in:APPROVED,REJECTED,ARCHIVED']);
        DB::transaction(function () use ($request, $data, $scope, $audit) {
            $questions = $scope->questions($request->user())->whereIn('id', $data['ids'])->lockForUpdate()->get();
            abort_unless($questions->count() === count($data['ids']), 403);
            foreach ($questions as $question) {
                $this->authorizeQuestion($request, $question, $scope);
                abort_unless(in_array($question->status, ['DRAFT', 'IN_REVIEW', 'REJECTED', 'APPROVED']), 409);
            }
            foreach ($questions as $question) {
                $old = $question->status;
                $question->update(['status' => $data['action']]);
                $audit->record('QUESTION_'.$data['action'], $question, ['status' => $old], ['status' => $data['action']]);
            }
            foreach ($questions->pluck('ai_generation_job_id')->filter()->unique() as $jobId) {
                AiGenerationJob::whereKey($jobId)->update(['accepted_count' => Question::where('ai_generation_job_id', $jobId)->where('status', 'APPROVED')->count()]);
            }
        });

        return back()->with('success', 'Selected questions updated.');
    }

    public function regenerate(Request $request, Question $question, AuthoringScope $scope): RedirectResponse
    {
        $this->authorizeQuestion($request, $question, $scope);
        $job = DB::transaction(function () use ($question, $request, $scope) {
            $question = Question::lockForUpdate()->findOrFail($question->id);
            $latest = $question->versions()->with('sources.documentChunk')->firstOrFail();
            $original = AiGenerationJob::findOrFail($question->ai_generation_job_id);
            $active = AiGenerationJob::where('center_id', $question->center_id)->whereIn('status', ['QUEUED', 'PROCESSING'])->where('request_json->replace_question_id', $question->id)->first();
            if ($active) {
                return $active;
            }
            $documents = $scope->documents($request->user())->whereIn('id', $latest->sources->pluck('documentChunk.source_document_id'))->get();
            abort_unless($documents->isNotEmpty(), 403);
            $data = array_merge($original->request_json, ['replace_question_id' => $question->id, 'number_of_questions' => 1, 'type_counts' => [$question->type->value => 1], 'difficulty_counts' => [$question->difficulty => 1], 'category_counts' => [$question->english_category => 1], 'source_chunk_ids' => $latest->sources->pluck('document_chunk_id')->all()]);
            $job = AiGenerationJob::create(['center_id' => $question->center_id, 'requested_by' => $request->user()->id, 'status' => 'QUEUED', 'request_json' => $data, 'progress_json' => ['done' => [], 'attempts' => [], 'invalid_count' => 0]]);
            $job->documents()->sync($documents->modelKeys());
            GenerateQuestionsJob::dispatch($job->id)->afterCommit();

            return $job;
        });
        $prefix = $request->user()->hasRole('ADMIN') ? '/admin' : '/teacher';

        return redirect($prefix.'/ai-jobs/'.$job->id.'/review')->with('success', 'Replacement queued. The existing version is preserved until a valid replacement is ready.');
    }

    private function authorizeQuestion(Request $request, Question $question, AuthoringScope $scope): void
    {
        abort_unless($request->user()->can('questions.manage') && $scope->questions($request->user())->whereKey($question->id)->exists() && ($request->user()->hasRole('ADMIN') || $question->created_by === $request->user()->id), 403);
    }
}
