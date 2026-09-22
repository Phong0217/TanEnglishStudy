<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoleName;
use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole(RoleName::ADMIN->value);
    }

    public function rules(): array
    {
        return ['name' => ['required', 'string', 'max:255'], 'email' => ['required', 'email', 'max:255', 'unique:users,email'], 'password' => ['required', Password::defaults()], 'role' => ['required', Rule::in([RoleName::TEACHER->value, RoleName::STUDENT->value])], 'code' => ['required', 'string', 'max:50', 'unique:teacher_profiles,teacher_code', 'unique:student_profiles,student_code'], 'status' => ['sometimes', Rule::enum(UserStatus::class)]];
    }
}
