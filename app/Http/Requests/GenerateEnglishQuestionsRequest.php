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
        return ['course_version_id' => 'required|integer', 'document_ids' => 'required|array|min:1|max:10', 'document_ids.*' => 'required|integer|distinct', 'request_key' => 'required|uuid', 'grade_level' => 'nullable|integer|min:1|max:12', 'cefr_level' => 'nullable|in:A1,A2,B1,B2,C1,C2', 'number_of_questions' => 'required|integer|min:1|max:60', 'type_counts' => 'required_unless:source_mode,extract_exact|array', 'difficulty_counts' => 'required_unless:source_mode,extract_exact|array', 'category_counts' => 'required_unless:source_mode,extract_exact|array', 'additional_constraints' => 'nullable|string|max:2000', 'source_mode' => 'nullable|in:generated,extract_exact', 'source_scope' => 'nullable|in:all,vocabulary_grammar,reading,writing'];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'source_mode' => $this->input('source_mode', 'generated'),
            'source_scope' => $this->input('source_scope', 'all'),
        ]);
    }

    public function after(): array
    {
        return [function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }
            if ($this->input('source_mode') === 'extract_exact') {
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
