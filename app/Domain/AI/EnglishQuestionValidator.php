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
        $output['source_group'] = $this->normalizeSourceGroup($output['source_group'] ?? [], $output, $slot, $sources);
        if (($slot['allow_any'] ?? false)) {
            // Exact extraction preserves the source question; difficulty is
            // not a source field and providers may return lower-case or an
            // unsupported label such as "unknown". Use a stable fallback
            // instead of rejecting an otherwise valid source question.
            $output['difficulty'] = $this->normalizeDifficulty($output['difficulty'] ?? null, $slot['difficulty'] ?? 'MEDIUM');
            if ($output['source_group']['activityType'] !== 'GENERAL') {
                $output['english_category'] = match ($output['source_group']['activityType']) {
                    'VOCABULARY_GRAMMAR', 'VOCABULARY' => 'vocabulary',
                    'GRAMMAR' => 'grammar',
                    'READING' => 'reading',
                    'WRITING' => 'writing',
                    default => $output['english_category'] ?? 'reading',
                };
            }
        }
        Validator::make($output, [
            'type' => ['required', Rule::in($slot['allow_any'] ?? false ? array_keys(config('english-ai.types')) : [$slot['type']])], 'difficulty' => ['required', Rule::in($slot['allow_any'] ?? false ? array_keys(config('english-ai.difficulties')) : [$slot['difficulty']])],
            'english_category' => ['required', Rule::in($slot['allow_any'] ?? false ? array_keys(config('english-ai.categories')) : [$slot['category']])], 'concept' => 'required|string|max:255',
            'content' => 'required|array', 'content.prompt' => 'required|string|max:2000',
            'answerKey' => 'required|array', 'explanation' => 'required|string|max:3000',
            'sources' => 'required|array|min:1|max:5', 'sources.*.chunkId' => 'required|integer', 'sources.*.sourceExcerpt' => 'required|string|max:3500',
            'source_group' => 'required|array', 'source_group.groupKey' => 'required|string|max:160', 'source_group.sectionTitle' => 'required|string|max:255',
            'source_group.activityType' => ['required', Rule::in(['VOCABULARY_GRAMMAR', 'VOCABULARY', 'GRAMMAR', 'READING', 'WRITING', 'LISTENING', 'SPEAKING', 'GENERAL'])],
            'source_group.passageKey' => 'nullable|string|max:160', 'source_group.passageText' => 'nullable|string|max:12000', 'source_group.questionNumber' => 'nullable|integer|min:1|max:9999', 'source_group.preserveSource' => 'required|boolean',
        ])->validate();
        if (($slot['allow_any'] ?? false) && ($output['source_group']['preserveSource'] ?? false) !== true) {
            $this->reject('Exact extraction must preserve the source question.');
        }
        if (in_array($output['type'], ['multiple_choice', 'multiple_select'], true) && is_string($output['content']['prompt'] ?? null)) {
            $output['content']['prompt'] = app(\App\Domain\Learning\QuestionPromptNormalizer::class)->normalize($output['content']['prompt']);
        }
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
        $output['skill'] = match ($output['source_group']['activityType']) {
            'VOCABULARY' => 'VOCABULARY', 'GRAMMAR' => 'GRAMMAR', 'READING' => 'READING',
            'WRITING' => 'WRITING', 'LISTENING' => 'LISTENING', 'SPEAKING' => 'SPEAKING',
            default => match ($output['english_category']) { 'vocabulary', 'word_form' => 'VOCABULARY', 'reading' => 'READING', 'writing' => 'WRITING', default => 'GRAMMAR' },
        };

        return $output;
    }

    private function normalizeSourceGroup(array $group, array $output, array $slot, array $sources): array
    {
        $sourceLookup = array_column($sources, null, 'id');
        $citedChunk = collect($output['sources'] ?? [])->map(fn ($source) => $sourceLookup[$source['chunkId'] ?? null] ?? null)->filter()->first();
        $metadata = (array) (($citedChunk ?? $sources[0] ?? [])['metadata'] ?? []);
        $activity = strtoupper((string) ($group['activityType'] ?? $metadata['activity_type'] ?? 'GENERAL'));
        // In exact mode the parsed section is authoritative. This prevents a
        // provider from labelling every extracted question as Reading when a
        // cited Vocabulary/Grammar/Writing chunk says otherwise.
        if (($slot['allow_any'] ?? false) && filled($metadata['activity_type'])) {
            $activity = strtoupper((string) $metadata['activity_type']);
        }
        $allowed = ['VOCABULARY_GRAMMAR', 'VOCABULARY', 'GRAMMAR', 'READING', 'WRITING', 'LISTENING', 'SPEAKING', 'GENERAL'];
        if (! in_array($activity, $allowed, true)) {
            $activity = match ($slot['category'] ?? '') {
                'reading' => 'READING', 'writing' => 'WRITING', 'vocabulary', 'word_form' => 'VOCABULARY', 'grammar' => 'GRAMMAR', default => 'GENERAL',
            };
        }
        $groupKey = trim((string) ($group['groupKey'] ?? $metadata['group_key'] ?? ''));
        if (($slot['allow_any'] ?? false) && filled($metadata['group_key'])) {
            $groupKey = trim((string) $metadata['group_key']);
        }
        if ($groupKey === '') {
            $groupKey = (string) ($metadata['section_title'] ?? $activity ?: 'general');
        }
        $sectionTitle = trim((string) ($group['sectionTitle'] ?? $metadata['section_title'] ?? ''));
        if (($slot['allow_any'] ?? false) && filled($metadata['section_title'])) {
            $sectionTitle = trim((string) $metadata['section_title']);
        }
        $passageKey = $group['passageKey'] ?? $metadata['passage_key'] ?? null;
        if (($slot['allow_any'] ?? false) && array_key_exists('passage_key', $metadata)) {
            $passageKey = $metadata['passage_key'];
        }

        return [
            'groupKey' => mb_substr($groupKey, 0, 160),
            'sectionTitle' => mb_substr($sectionTitle !== '' ? $sectionTitle : ucfirst(strtolower(str_replace('_', ' ', $activity))), 0, 255),
            'activityType' => $activity,
            'passageKey' => $passageKey ? mb_substr((string) $passageKey, 0, 160) : null,
            'passageText' => mb_substr((string) ($group['passageText'] ?? ''), 0, 12000),
            'questionNumber' => isset($group['questionNumber']) && is_numeric($group['questionNumber']) ? (int) $group['questionNumber'] : null,
            'preserveSource' => (bool) ($group['preserveSource'] ?? false),
        ];
    }

    private function normalizeDifficulty(mixed $value, string $fallback): string
    {
        $normalized = strtoupper(trim((string) $value));

        return match ($normalized) {
            'EASY', 'BEGINNER', 'BASIC' => 'EASY',
            'MEDIUM', 'INTERMEDIATE', 'AVERAGE' => 'MEDIUM',
            'HARD', 'ADVANCED' => 'HARD',
            default => in_array($fallback, array_keys(config('english-ai.difficulties')), true) ? $fallback : 'MEDIUM',
        };
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
