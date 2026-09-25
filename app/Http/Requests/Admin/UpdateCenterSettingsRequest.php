<?php

namespace App\Http\Requests\Admin;

use App\Enums\RoleName;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCenterSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole(RoleName::ADMIN->value) ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_logo' => ['sometimes', 'boolean'],
        ];
    }
}
