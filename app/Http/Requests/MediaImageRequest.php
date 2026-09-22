<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasAnyRole(['ADMIN', 'TEACHER']) ?? false;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ];
    }
}
