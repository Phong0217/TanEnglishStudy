<?php

namespace App\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class SaveAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('submissions.own');
    }

    public function rules(): array
    {
        return ['assignment_item_id' => ['required', 'integer', 'exists:assignment_items,id'], 'response' => ['nullable', 'array']];
    }
}
