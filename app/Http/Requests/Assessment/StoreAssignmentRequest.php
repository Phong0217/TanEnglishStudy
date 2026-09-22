<?php

namespace App\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('assignments.author');
    }

    public function rules(): array
    {
        return ['title' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string'], 'instructions' => ['nullable', 'string'], 'source_lesson_id' => ['nullable', 'integer', 'exists:lessons,id'], 'items' => ['required', 'array', 'min:1'], 'items.*.question_version_id' => ['nullable', 'integer', 'exists:question_versions,id'], 'items.*.lesson_block_id' => ['nullable', 'integer', 'exists:lesson_blocks,id'], 'items.*.points' => ['nullable', 'numeric', 'gt:0']];
    }
}
