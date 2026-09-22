<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaAudioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasAnyRole(['ADMIN', 'TEACHER']) ?? false;
    }

    public function rules(): array
    {
        return ['file' => ['required', 'file', 'mimes:mp3,wav,m4a,mp4,aac', 'max:51200']];
    }
}
