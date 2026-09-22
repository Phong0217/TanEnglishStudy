<?php

namespace App\Http\Requests\Learning;

use App\Domain\Learning\BlockSchemaValidator;
use App\Domain\Learning\BlockSchemaNormalizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class SaveLessonRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $blocks = $this->input('blocks');
        if (is_array($blocks)) {
            $this->merge([
                'blocks' => app(BlockSchemaNormalizer::class)->normalizeBlocks($blocks),
            ]);
        }
    }

    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('lesson'));
    }

    public function rules(): array
    {
        return ['title' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string'], 'instructions' => ['nullable', 'string'], 'estimated_duration_minutes' => ['nullable', 'integer', 'min:1', 'max:1440'], 'lock_version' => ['required', 'integer', 'min:1'], 'blocks' => ['present', 'array'], 'blocks.*.id' => ['nullable', 'integer'], 'blocks.*.block_type' => ['required', 'string'], 'blocks.*.content_json' => ['required', 'array'], 'blocks.*.answer_key_json' => ['nullable', 'array'], 'blocks.*.settings_json' => ['nullable', 'array'], 'blocks.*.points' => ['required', 'numeric', 'min:0'], 'blocks.*.required' => ['required', 'boolean'], 'blocks.*.grading_mode' => ['required', 'in:AUTO,TEACHER,AI_ASSISTED']];
    }

    public function after(): array
    {
        return [function (Validator $validator) {
            $service = app(BlockSchemaValidator::class);
            foreach ($this->input('blocks', []) as $index => $block) {
                try {
                    // Draft autosave must allow an unfinished Listening block while
                    // the teacher is still uploading audio and adding questions.
                    // Publish performs the strict validation in LessonController.
                    $service->validate($block, false);
                } catch (ValidationException $e) {
                    foreach ($e->errors() as $field => $messages) {
                        foreach ($messages as $message) {
                            $validator->errors()->add("blocks.{$index}.{$field}", $message);
                        }
                    }
                }
            }
        }];
    }
}
