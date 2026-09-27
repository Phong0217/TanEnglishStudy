<?php

namespace App\Http\Requests\AI;

use Illuminate\Foundation\Http\FormRequest;

class ImportAiQuestionsToLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('ai.generate') && $this->user()->can('questions.manage');
    }

    public function rules(): array
    {
        return [
            'lesson_id' => ['required', 'integer', 'exists:lessons,id'],
            'question_ids' => ['required', 'array', 'min:1', 'max:60'],
            'question_ids.*' => ['required', 'integer', 'distinct'],
        ];
    }
}
