<?php

namespace App\Domain\Documents;

use App\Jobs\ParseSourceDocumentJob;
use App\Models\SourceDocument;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use ZipArchive;

class ImportDocument
{
    public function store(User $user, UploadedFile $file, ?int $versionId): SourceDocument
    {
        $mime = $file->getMimeType();
        if ($mime === 'application/pdf' && ! str_starts_with(file_get_contents($file->getRealPath(), false, null, 0, 5), '%PDF-')) {
            throw ValidationException::withMessages(['documents' => 'Invalid PDF signature.']);
        }
        if (str_contains($mime, 'openxmlformats')) {
            $zip = new ZipArchive;
            if ($zip->open($file->getRealPath()) !== true) {
                throw ValidationException::withMessages(['documents' => 'Invalid Office document.']);
            }
            $size = 0;
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $size += $zip->statIndex($i)['size'];
            }
            $valid = $size <= 100 * 1024 * 1024 && $zip->numFiles <= 5000 && ($zip->locateName('word/document.xml') !== false || $mime !== 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            $zip->close();
            if (! $valid) {
                throw ValidationException::withMessages(['documents' => 'Invalid or oversized expanded Office document.']);
            }
        }
        $checksum = hash_file('sha256', $file->getRealPath());
        $existing = SourceDocument::where('center_id', $user->center_id)->where('checksum', $checksum)->first();
        if ($existing) {
            if ($existing->uploaded_by === $user->id && $existing->course_version_id === $versionId) {
                return $existing;
            }
            throw ValidationException::withMessages(['documents' => 'This file is already registered in the center.']);
        }
        $disk = config('filesystems.private_disk');
        $path = $file->store('documents/'.$user->center_id, $disk);
        if (! $path) {
            throw ValidationException::withMessages(['documents' => 'Private storage is unavailable.']);
        }
        $document = SourceDocument::create(['center_id' => $user->center_id, 'course_version_id' => $versionId, 'uploaded_by' => $user->id, 'original_name' => mb_substr(basename(str_replace(["\0", '/', '\\'], '-', $file->getClientOriginalName())), 0, 255), 'disk' => $disk, 'storage_path' => $path, 'mime_type' => $mime, 'file_size' => $file->getSize(), 'checksum' => $checksum, 'status' => 'UPLOADED']);
        ParseSourceDocumentJob::dispatch($document->id)->onConnection(config('english-ai.queue_connection'))->afterCommit();

        return $document;
    }
}
