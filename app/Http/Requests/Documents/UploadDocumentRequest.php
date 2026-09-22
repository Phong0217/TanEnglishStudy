<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('documents.manage');
    }

    public function rules(): array
    {
        return ['document' => ['required', 'file', 'max:'.config('lms.document_max_kb', 20480), 'mimes:pdf,docx,pptx,txt', 'mimetypes:application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.presentationml.presentation,text/plain'], 'course_version_id' => ['nullable', 'integer', 'exists:course_versions,id']];
    }
}
