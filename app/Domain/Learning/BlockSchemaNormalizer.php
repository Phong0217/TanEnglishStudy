<?php

namespace App\Domain\Learning;

use Illuminate\Support\Str;

/**
 * Repairs stable identifiers used by block collections before validation.
 *
 * Block IDs are part of the answer-key contract, so valid IDs are never
 * changed. Only missing or repeated IDs receive a new UUID. The first
 * occurrence of a repeated ID remains unchanged, which keeps existing answer
 * keys pointing at the same option wherever the old payload was ambiguous.
 */
class BlockSchemaNormalizer
{
    /**
     * Normalize one lesson block without changing its type or content values.
     */
    public function normalizeBlock(array $block): array
    {
        $block['content_json'] = $this->normalizeContent((array) ($block['content_json'] ?? []));

        return $block;
    }

    /**
     * Normalize a list of blocks (used by SaveLessonRequest).
     *
     * @param  array<int, array<string, mixed>>  $blocks
     * @return array<int, array<string, mixed>>
     */
    public function normalizeBlocks(array $blocks): array
    {
        return array_map(fn ($block) => is_array($block) ? $this->normalizeBlock($block) : $block, $blocks);
    }

    /**
     * @param  array<string, mixed>  $content
     * @return array<string, mixed>
     */
    private function normalizeContent(array $content): array
    {
        foreach (['items', 'pairs', 'options', 'targets'] as $key) {
            if (is_array($content[$key] ?? null)) {
                $content[$key] = $this->normalizeList($content[$key], $this->prefixFor($key));
            }
        }

        if (is_array($content['blanks'] ?? null)) {
            $content['blanks'] = $this->normalizeList($content['blanks'], 'blank');
            $content['blanks'] = array_map(function ($blank) {
                if (is_array($blank) && is_array($blank['options'] ?? null)) {
                    $blank['options'] = $this->normalizeList($blank['options'], 'option');
                }

                return $blank;
            }, $content['blanks']);
        }

        if (is_array($content['questions'] ?? null)) {
            $content['questions'] = $this->normalizeList($content['questions'], 'question');
            $content['questions'] = array_map(function ($question) {
                if (! is_array($question)) {
                    return $question;
                }

                if (is_array($question['content'] ?? null)) {
                    $question['content'] = $this->normalizeContent($question['content']);
                }

                // Legacy listening payloads keep options directly on the
                // question object instead of under content.
                $question = $this->normalizeContent($question);

                // Early listening dropdown questions stored one
                // `correctOptionId`. The grouped dropdown schema stores a
                // mapping per blank. Preserve the old answer when there is a
                // single blank so publishing/grading remains compatible.
                if (($question['type'] ?? null) === 'dropdown'
                    && is_array($question['content']['blanks'] ?? null)
                    && count($question['content']['blanks']) === 1
                    && ! empty($question['answer_key']['correctOptionId'])
                    && empty($question['answer_key']['answers'])) {
                    $blank = $question['content']['blanks'][0];
                    $blankId = (string) ($blank['id'] ?? 'blank');
                    $question['answer_key']['answers'] = [$blankId => $question['answer_key']['correctOptionId']];
                }

                return $question;
            }, $content['questions']);
        }

        if (is_array($content['children'] ?? null)) {
            $content['children'] = array_map(function ($child) {
                return is_array($child) ? $this->normalizeBlock($child) : $child;
            }, $content['children']);
        }

        return $content;
    }

    /**
     * @param  array<int|string, mixed>  $items
     * @return array<int|string, mixed>
     */
    private function normalizeList(array $items, string $prefix): array
    {
        $seen = [];

        foreach ($items as $index => $item) {
            if (! is_array($item)) {
                continue;
            }

            $id = $item['id'] ?? null;
            $normalizedId = is_scalar($id) ? trim((string) $id) : '';
            if ($normalizedId === '' || isset($seen[$normalizedId])) {
                do {
                    $normalizedId = $prefix.'-'.Str::uuid()->toString();
                } while (isset($seen[$normalizedId]));
            }

            $item['id'] = $normalizedId;
            $seen[$normalizedId] = true;
            $items[$index] = $item;
        }

        return $items;
    }

    private function prefixFor(string $key): string
    {
        return match ($key) {
            'pairs' => 'pair',
            'targets' => 'target',
            default => 'item',
        };
    }
}
