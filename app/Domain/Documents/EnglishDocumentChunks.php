<?php

namespace App\Domain\Documents;

class EnglishDocumentChunks
{
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
        $pageStart = null;
        $pageEnd = null;
        $flush = function () use (&$chunks, &$seen, &$buffer, &$unit, &$lesson, &$heading, &$type, &$pageStart, &$pageEnd) {
            $content = trim(implode("\n", $buffer));
            $hash = hash('sha256', $content);
            if ($content !== '' && ! isset($seen[$hash])) {
                $chunks[] = ['chunk_index' => count($chunks), 'heading' => $heading, 'page_number' => $pageStart,
                    'content' => $content, 'token_count' => (int) ceil(mb_strlen($content) / 4),
                    'metadata_json' => ['unit' => $unit, 'lesson' => $lesson, 'section_type' => $type, 'page_start' => $pageStart, 'page_end' => $pageEnd, 'analysis_method' => 'section-headings-v1']];
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
                } elseif (mb_strlen($line) < 160 && preg_match('/^(vocabulary|grammar|reading|dialogue|conversation|communication|language focus|review|practice|exercise|example|listening transcript)\b/i', $line, $match)) {
                    $flush();
                    $heading = $line;
                    $type = match (strtolower($match[1])) {
                        'conversation', 'communication' => 'dialogue', 'language focus' => 'language_focus', 'review', 'practice' => 'exercise', 'listening transcript' => 'transcript', default => strtolower($match[1])
                    };
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
}
