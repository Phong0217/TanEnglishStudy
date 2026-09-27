<?php

namespace App\Domain\AI;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GenerationBlueprint
{
    public function validate(array $data): array
    {
        Validator::make($data, ['number_of_questions' => 'required|integer|min:1|max:60', 'type_counts' => 'required|array', 'difficulty_counts' => 'required|array', 'category_counts' => 'required|array', 'type_counts.*' => 'integer|min:0|max:60', 'difficulty_counts.*' => 'integer|min:0|max:60', 'category_counts.*' => 'integer|min:0|max:60'])->validate();
        foreach (['type_counts' => 'types', 'difficulty_counts' => 'difficulties', 'category_counts' => 'categories'] as $field => $config) {
            if (array_diff(array_keys($data[$field]), array_keys(config('english-ai.'.$config))) || array_sum($data[$field]) !== (int) $data['number_of_questions']) {
                throw ValidationException::withMessages([$field => 'Use supported values and make the total equal the requested question count.']);
            }
        }

        return $data;
    }

    public function slots(array $data): array
    {
        if (($data['source_mode'] ?? 'generated') === 'extract_exact') {
            $category = match ($data['source_scope'] ?? 'all') {
                'vocabulary_grammar' => 'vocabulary',
                'writing' => 'writing',
                default => 'reading',
            };

            return array_map(fn ($i) => ['slot' => $i, 'type' => 'multiple_choice', 'difficulty' => 'MEDIUM', 'category' => $category], range(0, (int) $data['number_of_questions'] - 1));
        }
        $this->validate($data);
        $expand = fn ($counts) => array_merge(...array_map(fn ($key, $count) => array_fill(0, $count, $key), array_keys($counts), array_values($counts)));
        $types = $expand($data['type_counts']);
        $difficulties = $expand($data['difficulty_counts']);
        $categories = $expand($data['category_counts']);

        return array_map(fn ($i) => ['slot' => $i, 'type' => $types[$i], 'difficulty' => $difficulties[$i], 'category' => $categories[$i]], range(0, $data['number_of_questions'] - 1));
    }
}
