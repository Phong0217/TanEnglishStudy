<?php

namespace App\Domain\AI;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenAiQuestionGenerator implements AiQuestionGeneratorInterface
{
    public function generate(array $request, array $sources): array
    {
        if (! $key = config('services.ai.key')) {
            throw new RuntimeException('AI_API_KEY is not configured.');
        }
        $response = Http::withToken($key)->timeout((int) config('services.ai.timeout', 60))
            ->post('https://api.openai.com/v1/responses', [
                'model' => config('services.ai.model'), 'store' => false,
                'input' => [['role' => 'system', 'content' => QuestionGenerationSchema::prompt()],
                    ['role' => 'user', 'content' => json_encode(['request' => $request, 'sources' => $sources], JSON_THROW_ON_ERROR)]],
                'text' => ['format' => ['type' => 'json_schema', 'name' => 'english_questions', 'strict' => true, 'schema' => QuestionGenerationSchema::definition()]],
            ]);
        if (! $response->successful()) {
            throw new RuntimeException('AI service failed (HTTP '.$response->status().'). Retry the remaining batch.');
        }
        if ($response->json('status') !== 'completed') {
            throw new RuntimeException('AI response was incomplete.');
        }
        $content = collect($response->json('output', []))->flatMap(fn ($item) => $item['content'] ?? [])->firstWhere('type', 'output_text');
        $text = is_array($content) ? ($content['text'] ?? null) : null;
        if (! is_string($text)) {
            throw new RuntimeException('AI returned no structured output.');
        }
        $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
        if (! is_array($data)) {
            throw new RuntimeException('AI returned invalid JSON.');
        }
        $data['usage'] = $response->json('usage', []);

        return $data;
    }
}
