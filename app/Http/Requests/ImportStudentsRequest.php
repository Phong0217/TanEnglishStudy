<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportStudentsRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->hasAnyRole(['ADMIN', 'TEACHER']) ?? false; }

    public function rules(): array
    {
        return ['file' => ['required', 'file', 'mimes:xlsx,csv,txt', 'max:10240']];
    }
}
