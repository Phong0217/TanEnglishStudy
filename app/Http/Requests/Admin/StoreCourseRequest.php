<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoleName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole(RoleName::ADMIN->value);
    }

    public function rules(): array
    {
        return ['code' => ['required', 'string', 'max:50', Rule::unique('courses')->where('center_id', $this->user()->center_id)], 'title' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string'], 'grade_level' => ['nullable', 'integer', 'between:1,12'], 'cefr_level' => ['nullable', Rule::in(['A1', 'A2', 'B1', 'B2', 'C1', 'C2'])]];
    }
}
