<?php

namespace App\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class GradeSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('grade', $this->route('submission'));
    }

    public function rules(): array
    {
        return ['scores' => ['required', 'array'], 'scores.*' => ['required', 'numeric', 'min:0'], 'feedback' => ['nullable', 'string', 'max:5000'], 'reason' => ['required', 'string', 'min:3', 'max:1000']];
    }
}
