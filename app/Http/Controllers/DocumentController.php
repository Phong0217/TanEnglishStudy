<?php

namespace App\Http\Controllers;

use App\Domain\AI\AuthoringScope;
use App\Domain\Documents\ImportDocument;
use App\Http\Requests\Documents\UploadDocumentRequest;
use App\Jobs\ParseSourceDocumentJob;
use App\Models\SourceDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class DocumentController extends Controller
{
    public function index(Request $request, AuthoringScope $scope): Response
    {
        abort_unless($request->user()->can('documents.manage'), 403);

        return Inertia::render('Documents/Index', ['documents' => $scope->documents($request->user())->with('courseVersion.course')->withCount('chunks')->latest()->paginate(15), 'courseVersions' => $scope->versions($request->user())->with('course')->get()]);
    }

    public function store(UploadDocumentRequest $request, AuthoringScope $scope, ImportDocument $import): RedirectResponse
    {
        $version = $request->validated('course_version_id');
        if ($version) {
            $scope->versions($request->user())->findOrFail($version);
        }
        abort_if(! $version && ! $request->user()->hasRole('ADMIN'), 403);
        $import->store($request->user(), $request->file('document'), $version ? (int) $version : null);

        return back()->with('success', 'Document uploaded and queued for processing.');
    }

    public function uploadMany(Request $request, AuthoringScope $scope, ImportDocument $import): RedirectResponse
    {
        abort_unless($request->user()->can('documents.manage'), 403);
        $data = $request->validate(['course_version_id' => 'required|integer', 'documents' => 'required|array|min:1|max:10', 'documents.*' => ['required', 'file', 'max:'.config('lms.document_max_kb', 20480), 'mimes:pdf,docx', 'mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document']]);
        $version = $scope->versions($request->user())->findOrFail($data['course_version_id']);
        DB::transaction(function () use ($request, $import, $version) {
            foreach ($request->file('documents') as $file) {
                $import->store($request->user(), $file, $version->id);
            }
        });

        return back()->with('success', 'Documents uploaded. Parsing will run in the background.');
    }

    public function show(Request $request, SourceDocument $document, AuthoringScope $scope): Response
    {
        $this->access($request, $document, $scope);
        $document->load('chunks');

        return Inertia::render('Documents/Show', ['document' => $document]);
    }

    public function retry(Request $request, SourceDocument $document, AuthoringScope $scope): RedirectResponse
    {
        $this->access($request, $document, $scope);
        abort_unless(in_array($document->status, ['FAILED', 'NEEDS_REVIEW']), 409);
        $document->update(['status' => 'UPLOADED', 'error_message' => null]);
        ParseSourceDocumentJob::dispatch($document->id)->onConnection(config('english-ai.queue_connection'));

        return back()->with('success', 'Document parsing queued again.');
    }

    private function access(Request $request, SourceDocument $document, AuthoringScope $scope): void
    {
        abort_unless($request->user()->can('documents.manage') && $scope->documents($request->user())->whereKey($document->id)->exists(), 403);
    }
}
