<?php

namespace App\Domain\Learning;

/**
 * Keeps the question prompt separate from its options. Imported PDFs often
 * place A/B/C/D options directly after the question text; options are stored
 * in content.options and must not be rendered twice.
 */
class QuestionPromptNormalizer
{
    public function normalize(string $prompt): string
    {
        $prompt = preg_replace(
            '/^\s*(?:(?:(?:question|q)\s*\d+\s*(?:[.\-:)]\s*)?)|(?:\d+\s*[.\-:)]\s*))/iu',
            '',
            trim($prompt),
            1
        ) ?? trim($prompt);

        preg_match_all('/(?:^|\s)([A-D])[.)](?=\s)/iu', $prompt, $matches, PREG_OFFSET_CAPTURE);
        $labels = array_values(array_unique(array_map(
            static fn (array $match): string => strtoupper((string) $match[0]),
            $matches[1] ?? []
        )));

        // Require at least two option labels so an ordinary sentence such as
        // "Option A." is never truncated accidentally.
        if (count($labels) >= 2 && in_array('A', $labels, true)) {
            $firstOffset = $matches[0][0][1] ?? null;
            if (is_int($firstOffset)) {
                $prompt = substr($prompt, 0, $firstOffset);
            }
        }

        return trim($prompt);
    }
}
