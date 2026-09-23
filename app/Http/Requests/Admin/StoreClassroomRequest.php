<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoleName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole(RoleName::ADMIN->value);
    }

    public function rules(): array
    {
        return ['name' => ['required', 'string', 'max:255'], 'code' => ['required', 'string', 'max:50', Rule::unique('classrooms')->where('center_id', $this->user()->center_id)], 'primary_teacher_id' => ['nullable', 'integer', 'exists:users,id'], 'description' => ['nullable', 'string'], 'start_date' => ['nullable', 'date'], 'end_date' => ['nullable', 'date', 'after_or_equal:start_date']];
    }
}
