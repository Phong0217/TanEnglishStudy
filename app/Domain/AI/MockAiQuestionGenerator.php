<?php

namespace App\Domain\AI;

class MockAiQuestionGenerator implements AiQuestionGeneratorInterface
{
    public function generate(array $request, array $sources): array
    {
        $chunk = $sources[0] ?? ['id' => null, 'page_number' => null, 'content' => ''];
        $count = min((int) ($request['number_of_questions'] ?? 1), 10);

        return ['questions' => collect(range(1, $count))->map(fn ($i) => ['type' => 'multiple_choice', 'skill' => $request['skill'] ?? 'READING', 'difficulty' => $request['difficulty'] ?? 'MEDIUM', 'content' => ['prompt' => "According to the selected source, which statement is supported? ({$i})", 'options' => [['id' => 'a', 'text' => mb_substr($chunk['content'], 0, 80)], ['id' => 'b', 'text' => 'A statement not found in the source'], ['id' => 'c', 'text' => 'None of the above']]], 'answerKey' => ['correctOptionId' => 'a'], 'settings' => [], 'explanation' => 'The first option is directly grounded in the selected excerpt.', 'rubric' => null, 'sources' => [['chunkId' => $chunk['id'], 'pageNumber' => $chunk['page_number'], 'sourceExcerpt' => mb_substr($chunk['content'], 0, 240)]]])->all(), 'usage' => ['input_tokens' => 0, 'output_tokens' => 0]];
    }
}
