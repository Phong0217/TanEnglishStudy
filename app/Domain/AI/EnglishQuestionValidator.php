<?php

namespace App\Domain\AI;

use App\Domain\Learning\BlockSchemaValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class EnglishQuestionValidator
{
    public function validate(array $output, array $slot, array $sources): array
    {
        Validator::make($output, [
            'type' => ['required', Rule::in([$slot['type']])], 'difficulty' => ['required', Rule::in([$slot['difficulty']])],
            'english_category' => ['required', Rule::in([$slot['category']])], 'concept' => 'required|string|max:255',
            'content' => 'required|array', 'content.prompt' => 'required|string|max:2000',
            'answerKey' => 'required|array', 'explanation' => 'required|string|max:3000',
            'sources' => 'required|array|min:1|max:5', 'sources.*.chunkId' => 'required|integer', 'sources.*.sourceExcerpt' => 'required|string|max:3500',
        ])->validate();
        app(BlockSchemaValidator::class)->validate(['block_type' => $output['type'], 'content_json' => $output['content'], 'answer_key_json' => $output['answerKey'], 'grading_mode' => 'AUTO', 'points' => 1]);
        $options = $output['content']['options'] ?? [];
        $texts = array_map(fn ($o) => $this->normalize($o['text']), $options);
        if (count($texts) !== count(array_unique($texts))) {
            $this->reject('Distractors must be distinct.');
        }
        if ($output['type'] === 'short_answer') {
            $answers = $output['answerKey']['acceptedAnswers'] ?? [];
            if (! is_array($answers) || ! $answers || count($answers) > 20 || count(array_filter($answers, fn ($v) => is_string($v) && trim($v) !== '')) !== count($answers)) {
                $this->reject('Text input requires non-empty accepted answers.');
            }
        }
        $byId = array_column($sources, null, 'id');
        foreach ($output['sources'] as &$source) {
            $chunk = $byId[$source['chunkId']] ?? null;
            if (! $chunk || ! str_contains($this->normalize($chunk['content']), $this->normalize($source['sourceExcerpt']))) {
                $this->reject('Evidence must quote a selected source chunk.');
            }
            $source['pageNumber'] = $chunk['page_number'];
        }
        unset($source);
        // Do not trust provider-supplied grading or visibility settings.
        $output['settings'] = ['trimWhitespace' => true, 'caseSensitive' => false];
        $output['skill'] = match ($slot['category']) {
            'vocabulary', 'word_form' => 'VOCABULARY', 'reading' => 'READING', default => 'GRAMMAR'
        };

        return $output;
    }

    public function normalize(string $text): string
    {
        return trim(preg_replace('/[^\pL\pN]+/u', ' ', mb_strtolower(strip_tags($text))) ?? '');
    }

    public function duplicate(string $prompt, array $existing): bool
    {
        $a = $this->normalize($prompt);
        foreach ($existing as $previous) {
            $b = $this->normalize($previous);
            if ($a === $b) {
                return true;
            }
            similar_text($a, $b, $percent);
            $tokensA = array_unique(explode(' ', $a));
            $tokensB = array_unique(explode(' ', $b));
            $union = count(array_unique(array_merge($tokensA, $tokensB)));
            if ($percent >= 88 || ($union && count(array_intersect($tokensA, $tokensB)) / $union >= .8)) {
                return true;
            }
        }

        return false;
    }

    private function reject(string $message): never
    {
        throw ValidationException::withMessages(['question' => $message]);
    }
}
