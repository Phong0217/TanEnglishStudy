<?php

namespace App\Domain\Documents;

class EnglishDocumentChunks
{
    /**
     * Stored on every parsed document so documents parsed by an older
     * container can be rebuilt before AI generation uses their chunks.
     */
    public const ANALYSIS_METHOD = 'section-headings-v2';

    public function build(array $pages): array
    {
        $edges = [];
        foreach ($pages as $page) {
            $lines = array_values(array_filter(explode("\n", trim($page['text']))));
            foreach (array_unique(array_merge(array_slice($lines, 0, 2), array_slice($lines, -2))) as $line) {
                $edges[trim($line)] = ($edges[trim($line)] ?? 0) + 1;
            }
        }
        $chunks = [];
        $seen = [];
        $buffer = [];
        $unit = null;
        $lesson = null;
        $heading = null;
        $type = 'general_content';
        $activityType = 'GENERAL';
        $groupKey = 'general';
        $passageKey = null;
        $passageIndex = 0;
        $pageStart = null;
        $pageEnd = null;
        $flush = function () use (&$chunks, &$seen, &$buffer, &$unit, &$lesson, &$heading, &$type, &$activityType, &$groupKey, &$passageKey, &$pageStart, &$pageEnd) {
            $content = trim(implode("\n", $buffer));
            $hash = hash('sha256', $content);
            if ($content !== '' && ! isset($seen[$hash])) {
                $chunks[] = ['chunk_index' => count($chunks), 'heading' => $heading, 'page_number' => $pageStart,
                    'content' => $content, 'token_count' => (int) ceil(mb_strlen($content) / 4),
                    'metadata_json' => [
                        'unit' => $unit,
                        'lesson' => $lesson,
                        'section_type' => $type,
                        'activity_type' => $activityType,
                        'group_key' => $groupKey,
                        'section_title' => $heading,
                        'passage_key' => $passageKey,
                        'page_start' => $pageStart,
                        'page_end' => $pageEnd,
                        'analysis_method' => self::ANALYSIS_METHOD,
                    ]];
                $seen[$hash] = true;
            }
            $buffer = [];
            $pageStart = null;
        };
        foreach ($pages as $page) {
            foreach (preg_split('/\R/u', $page['text']) ?: [] as $line) {
                $line = trim(preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x{FFFD}]/u', '', $line) ?? '');
                $line = preg_replace('/[\t \x{00a0}]+/u', ' ', $line);
                if (! $line || preg_match('/^(?:page\s*)?\d+$/i', $line) || preg_match('/\.{4,}\s*\d+$/', $line)) {
                    continue;
                }
                if (count($pages) > 2 && ($edges[$line] ?? 0) >= max(3, count($pages) * .6) && ! preg_match('/^(unit|lesson|vocabulary|grammar|reading)/i', $line)) {
                    continue;
                }
                if (preg_match('/^(unit|lesson)\s+\d+\b/i', $line, $match)) {
                    $flush();
                    if (strtolower($match[1]) === 'unit') {
                        $unit = $line;
                        $lesson = null;
                    } else {
                        $lesson = $line;
                    }
                    $heading = $line;
                    $type = 'general_content';
                    $activityType = 'GENERAL';
                    $groupKey = 'general';
                    $passageKey = null;
                    $passageIndex = 0;
                } elseif (mb_strlen($line) < 160 && preg_match('/^(vocabulary|grammar|reading|dialogue|conversation|communication|language focus|review|practice|exercise|example|listening transcript)\b/i', $line, $match)) {
                    $flush();
                    $heading = $line;
                    $type = match (strtolower($match[1])) {
                        'conversation', 'communication' => 'dialogue', 'language focus' => 'language_focus', 'review', 'practice' => 'exercise', 'listening transcript' => 'transcript', default => strtolower($match[1])
                    };
                    [$activityType, $groupKey] = $this->classifyHeading($line, $type);
                    $passageKey = null;
                    $passageIndex = 0;
                } elseif (mb_strlen($line) < 160 && preg_match('/^(?:[A-Z][.)-]?\s*)?(?:vocabulary\s*(?:&|and)\s*grammar|grammar\s*(?:&|and)\s*vocabulary|language|reading|writing|listening|speaking)\b/i', $line)) {
                    $flush();
                    $heading = $line;
                    [$activityType, $groupKey] = $this->classifyHeading($line, 'general_content');
                    $type = strtolower($activityType);
                    $passageKey = null;
                    $passageIndex = 0;
                } elseif ($activityType === 'READING' && preg_match('/^(?:read|reading|passage|text)\b/i', $line)) {
                    $passageIndex++;
                    $passageKey = $groupKey.':p'.$passageIndex;
                }
                // Prefer section and paragraph boundaries; bound very long paragraphs without losing text.
                foreach (mb_str_split($line, 3000) as $part) {
                    if (mb_strlen(implode("\n", $buffer)) + mb_strlen($part) > 3500) {
                        $flush();
                    }
                    $pageStart ??= $page['number'];
                    $pageEnd = $page['number'];
                    $buffer[] = $part;
                }
            }
        }
        $flush();

        return $chunks;
    }

    /** @return array{0:string,1:string} */
    private function classifyHeading(string $heading, string $fallback): array
    {
        $value = mb_strtolower(trim($heading));
        $value = preg_replace('/^[a-z]\s*[.)-]\s*/u', '', $value) ?? $value;
        $value = preg_replace('/\s+/u', ' ', $value) ?? $value;
        if (str_contains($value, 'vocabulary') && str_contains($value, 'grammar')) {
            return ['VOCABULARY_GRAMMAR', 'vocabulary_grammar'];
        }
        foreach (['reading' => 'READING', 'writing' => 'WRITING', 'listening' => 'LISTENING', 'speaking' => 'SPEAKING', 'grammar' => 'GRAMMAR', 'vocabulary' => 'VOCABULARY'] as $needle => $activity) {
            if (str_contains($value, $needle)) {
                return [$activity, $activity === 'READING' ? 'reading' : strtolower($activity)];
            }
        }

        return ['GENERAL', $fallback === 'general_content' ? 'general' : strtolower($fallback)];
    }
}
