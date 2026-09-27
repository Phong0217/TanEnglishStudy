<?php

namespace App\Jobs;

use App\Domain\Documents\DocumentParser;
use App\Domain\Documents\EnglishDocumentChunks;
use App\Models\SourceDocument;
use App\Models\QuestionSource;
use App\Notifications\SystemNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ParseSourceDocumentJob implements ShouldQueue
{
    use Dispatchable,InteractsWithQueue,Queueable,SerializesModels;

    public int $tries = 3;

    public function __construct(public int $documentId) {}

    public function handle(DocumentParser $parser): void
    {
        $document = SourceDocument::withoutGlobalScopes()->with('chunks')->findOrFail($this->documentId);
        if ($document->status === 'READY' && ! $document->requiresChunkReparse()) {
            return;
        }
        $document->update(['status' => 'PROCESSING', 'error_message' => null]);
        $temporary = null;
        try {
            $storage = Storage::disk($document->disk);
            if ($document->disk === 'private' || $document->disk === 'local') {
                $path = $storage->path($document->storage_path);
            } else {
                $temporary = tempnam(sys_get_temp_dir(), 'lms-document-');
                $stream = $storage->readStream($document->storage_path);
                $target = fopen($temporary, 'wb');
                stream_copy_to_stream($stream, $target);
                fclose($stream);
                fclose($target);
                $path = $temporary;
            }$result = $parser->parse($path, $document->mime_type);
            $pages = collect($result['pages']);
            $textLength = $pages->sum(fn ($page) => mb_strlen(trim($page['text'])));
            $status = $textLength < 20 ? 'NEEDS_REVIEW' : 'READY';
            DB::transaction(function () use ($document, $result, $pages, $status) {
                $chunks = app(EnglishDocumentChunks::class)->build($pages->all());
                $existing = $document->chunks()->get()->keyBy('chunk_index');
                $seenIndexes = [];
                foreach ($chunks as $chunk) {
                    $index = (int) $chunk['chunk_index'];
                    $seenIndexes[$index] = true;
                    $model = $existing->get($index);
                    if ($model) {
                        // Preserve chunk IDs so existing QuestionSource rows remain valid.
                        $model->update($chunk);
                    } else {
                        $document->chunks()->create($chunk);
                    }
                }
                foreach ($existing as $index => $model) {
                    if (isset($seenIndexes[(int) $index])) {
                        continue;
                    }
                    if (QuestionSource::where('document_chunk_id', $model->id)->exists()) {
                        $metadata = (array) ($model->metadata_json ?? []);
                        $metadata['superseded'] = true;
                        $model->update(['metadata_json' => $metadata]);
                    } else {
                        $model->delete();
                    }
                }
                $metadata = array_map(fn ($chunk) => $chunk['metadata_json'] ?? [], $chunks);
                $document->update([
                    'status' => $status,
                    'page_count' => $pages->count(),
                    'parser_name' => $result['parser'],
                    'parse_confidence' => null,
                    'parser_metadata_json' => [
                        'chunks' => count($chunks),
                        'sections' => array_values(array_unique(array_filter(array_map(fn ($item) => $item['section_type'] ?? null, $metadata)))),
                        'activity_types' => array_values(array_unique(array_filter(array_map(fn ($item) => $item['activity_type'] ?? null, $metadata)))),
                        'analysis_method' => EnglishDocumentChunks::ANALYSIS_METHOD,
                    ],
                ]);
            });
            $document->load('uploader');
            $document->uploader->notify(new SystemNotification('Document processed', $document->original_name.' is '.$status.'.', '/admin/documents'));
        } catch (Throwable $e) {
            $document->update(['status' => 'FAILED', 'error_message' => mb_substr($e->getMessage(), 0, 2000)]);
            $document->load('uploader');
            $document->uploader->notify(new SystemNotification('Document processing failed', $document->original_name.' could not be processed.', '/admin/documents'));
            throw $e;
        } finally {
            if ($temporary && is_file($temporary)) {
                unlink($temporary);
            }
        }
    }

    private function chunks(string $text, int $size): array
    {
        if ($text === '') {
            return [];
        }$result = [];
        while (mb_strlen($text) > $size) {
            $cut = mb_strrpos(mb_substr($text, 0, $size), "\n");
            if ($cut === false || $cut < $size / 2) {
                $cut = $size;
            }$result[] = trim(mb_substr($text, 0, $cut));
            $text = trim(mb_substr($text, $cut));
        }$result[] = trim($text);

        return array_values(array_filter($result));
    }
}
