<?php

namespace App\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class DeliverAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('assignments.deliver');
    }

    public function rules(): array
    {
        return ['classroom_id' => ['required', 'integer', 'exists:classrooms,id'], 'open_at' => ['required', 'date'], 'due_at' => ['required', 'date', 'after_or_equal:open_at'], 'close_at' => ['nullable', 'date', 'after_or_equal:due_at'], 'max_attempts' => ['required', 'integer', 'min:1', 'max:20'], 'time_limit_minutes' => ['nullable', 'integer', 'gt:0'], 'allow_late_submission' => ['required', 'boolean'], 'allow_review' => ['sometimes', 'boolean'], 'show_correct_answers' => ['sometimes', 'boolean'], 'result_release_policy' => ['required', 'in:MANUAL,AFTER_GRADING,AFTER_DUE_DATE']];
    }
}
