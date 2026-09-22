<?php

namespace App\Http\Requests;

use App\Domain\AI\GenerationBlueprint;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class GenerateEnglishQuestionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('ai.generate');
    }

    public function rules(): array
    {
        return ['course_version_id' => 'required|integer', 'document_ids' => 'required|array|min:1|max:10', 'document_ids.*' => 'required|integer|distinct', 'request_key' => 'required|uuid', 'grade_level' => 'nullable|integer|min:1|max:12', 'cefr_level' => 'nullable|in:A1,A2,B1,B2,C1,C2', 'number_of_questions' => 'required|integer|min:1|max:60', 'type_counts' => 'required|array', 'difficulty_counts' => 'required|array', 'category_counts' => 'required|array', 'additional_constraints' => 'nullable|string|max:2000'];
    }

    public function after(): array
    {
        return [function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }
            try {
                app(GenerationBlueprint::class)->validate($this->validated());
            } catch (ValidationException $e) {
                foreach ($e->errors() as $key => $messages) {
                    foreach ($messages as $message) {
                        $validator->errors()->add($key, $message);
                    }
                }
            }
        }];
    }
}
