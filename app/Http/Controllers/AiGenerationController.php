<?php

namespace App\Http\Controllers;

use App\Domain\AI\AuthoringScope;
use App\Http\Requests\GenerateEnglishQuestionsRequest;
use App\Jobs\GenerateQuestionsJob;
use App\Models\AiGenerationJob;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class AiGenerationController extends Controller
{
    public function index(Request $request, AuthoringScope $scope): Response
    {
        abort_unless($request->user()->can('ai.generate'), 403);

        return Inertia::render('AI/Index', [
            'jobs' => $scope->jobs($request->user())->latest()->paginate(15),
            'documents' => $scope->documents($request->user())->latest()->limit(100)->get(['id', 'course_version_id', 'original_name', 'status', 'page_count', 'error_message', 'parser_metadata_json']),
            'courseVersions' => $scope->versions($request->user())->with('course')->get()->map(fn ($v) => ['id' => $v->id, 'label' => $v->course->title.' · '.$v->code, 'grade_level' => $v->course->grade_level, 'cefr_level' => $v->course->cefr_level]),
            'options' => ['types' => config('english-ai.types'), 'categories' => config('english-ai.categories'), 'difficulties' => config('english-ai.difficulties')],
            'providerReady' => config('services.ai.provider') === 'openai' && filled(config('services.ai.key')),
        ]);
    }

    public function store(GenerateEnglishQuestionsRequest $request, AuthoringScope $scope): RedirectResponse
    {
        $data = $request->validated();
        $version = $scope->versions($request->user())->with('course')->findOrFail($data['course_version_id']);
        $documents = $scope->documents($request->user())->where('course_version_id', $version->id)->where('status', 'READY')->whereIn('id', $data['document_ids'])->get();
        abort_unless($documents->count() === count($data['document_ids']), 403);
        $data['grade_level'] ??= $version->course->grade_level;
        $data['cefr_level'] ??= $version->course->cefr_level;
        $job = DB::transaction(function () use ($request, $data, $documents) {
            User::whereKey($request->user()->id)->lockForUpdate()->firstOrFail();
            $existing = AiGenerationJob::where('center_id', $request->user()->center_id)->where('requested_by', $request->user()->id)->where('request_key', $data['request_key'])->first();
            if ($existing) {
                return $existing;
            }
            $job = AiGenerationJob::create(['center_id' => $request->user()->center_id, 'requested_by' => $request->user()->id, 'request_key' => $data['request_key'], 'status' => 'QUEUED', 'request_json' => collect($data)->except(['document_ids', 'request_key'])->all(), 'progress_json' => ['done' => [], 'attempts' => [], 'invalid_count' => 0, 'phase' => 'ANALYZING']]);
            $job->documents()->sync($documents->modelKeys());
            GenerateQuestionsJob::dispatch($job->id)->afterCommit();

            return $job;
        });

        return redirect($this->prefix($request).'/ai-jobs/'.$job->id.'/review')->with('success', 'English question generation queued.');
    }

    public function show(Request $request, AiGenerationJob $job, AuthoringScope $scope): Response
    {
        $this->access($request, $job, $scope);
        $job->load(['questions.versions.sources.documentChunk.sourceDocument', 'documents']);

        return Inertia::render('AI/Review', ['job' => $job, 'options' => ['types' => config('english-ai.types'), 'categories' => config('english-ai.categories'), 'difficulties' => config('english-ai.difficulties')]]);
    }

    public function status(Request $request, AiGenerationJob $job, AuthoringScope $scope): JsonResponse
    {
        $this->access($request, $job, $scope);

        return response()->json(['success' => true, 'data' => $job->only(['id', 'status', 'generated_count', 'accepted_count', 'progress_json', 'error_message', 'completed_at'])]);
    }

    public function cancel(Request $request, AiGenerationJob $job, AuthoringScope $scope): RedirectResponse
    {
        $this->access($request, $job, $scope);
        AiGenerationJob::whereKey($job->id)->whereIn('status', ['QUEUED', 'PROCESSING'])->update(['status' => 'CANCELLED', 'completed_at' => now()]);

        return back()->with('success', 'Generation cancelled. Existing drafts are preserved.');
    }

    public function retry(Request $request, AiGenerationJob $job, AuthoringScope $scope): RedirectResponse
    {
        $this->access($request, $job, $scope);
        DB::transaction(function () use ($job) {
            $current = AiGenerationJob::lockForUpdate()->findOrFail($job->id);
            abort_unless($current->status === 'FAILED', 409);
            $progress = $current->progress_json ?? [];
            $progress['attempts'] = [];
            $current->update(['status' => 'QUEUED', 'error_message' => null, 'completed_at' => null, 'progress_json' => $progress]);
            GenerateQuestionsJob::dispatch($job->id)->afterCommit();
        });

        return back()->with('success', 'Only missing questions have been queued again.');
    }

    private function access(Request $request, AiGenerationJob $job, AuthoringScope $scope): void
    {
        abort_unless($request->user()->can('ai.generate') && $scope->jobs($request->user())->whereKey($job->id)->exists(), 403);
    }

    private function prefix(Request $request): string
    {
        return $request->user()->hasRole('ADMIN') ? '/admin' : '/teacher';
    }
}
