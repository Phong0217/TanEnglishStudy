<?php

namespace App\Domain\Assessment;

use App\Models\AssignmentItem;

class GradingService
{
    public function grade(AssignmentItem $item, ?array $response): ?float
    {
        $answer = $item->answer_key_snapshot_json ?? [];
        $settings = $item->settings_snapshot_json ?? [];
        $correct = match ($item->item_type) {
            'multiple_choice' => ($response['selectedOptionId'] ?? null) === ($answer['correctOptionId'] ?? null),
            'true_false' => is_bool($response['value'] ?? null) && $response['value'] === ($answer['correct'] ?? null),
            'multiple_select' => $this->setsEqual($response['selectedOptionIds'] ?? [], $answer['correctOptionIds'] ?? []),
            'fill_blank', 'short_answer' => $this->accepted($response['text'] ?? '', $answer['acceptedAnswers'] ?? [], $settings),
            'dropdown' => ($response['answers'] ?? []) === ($answer['answers'] ?? []),
            'matching' => ($response['matches'] ?? []) === ($answer['matches'] ?? []),
            'ordering' => ($response['order'] ?? []) === ($answer['correctOrder'] ?? []),
            'drag_drop' => ($response['mapping'] ?? []) === ($answer['mapping'] ?? []),
            default => null,
        };
        if ($correct === null) {
            return null;
        }
        if ($item->item_type === 'multiple_select' && ($settings['partialCredit'] ?? false)) {
            return $this->partialSelect($item, $response['selectedOptionIds'] ?? [], $answer['correctOptionIds'] ?? []);
        }

        return $correct ? (float) $item->points : 0.0;
    }

    private function setsEqual(array $left, array $right): bool
    {
        sort($left);
        sort($right);

        return $left === $right;
    }

    private function accepted(string $value, array $accepted, array $settings): bool
    {
        $normalize = function (string $text) use ($settings) {
            if ($settings['trimWhitespace'] ?? true) {
                $text = trim($text);
            }if ($settings['normalizeInternalWhitespace'] ?? true) {
                $text = preg_replace('/\s+/u', ' ', $text) ?? $text;
            }if ($settings['ignoreTerminalPunctuation'] ?? false) {
                $text = preg_replace('/[.!?]+$/u', '', $text) ?? $text;
            }if (! ($settings['caseSensitive'] ?? false)) {
                $text = mb_strtolower($text);
            }

            return $text;
        };
        $value = $normalize($value);

        return collect($accepted)->contains(fn ($candidate) => $normalize((string) $candidate) === $value);
    }

    private function partialSelect(AssignmentItem $item, array $selected, array $correct): float
    {
        if (! $correct) {
            return 0.0;
        }$valid = count(array_intersect($selected, $correct));
        $invalid = count(array_diff($selected, $correct));
        $ratio = max(0, ($valid - $invalid) / count($correct));

        return round(min((float) $item->points, (float) $item->points * $ratio), 2);
    }
}
