<?php

namespace App\Domain\AI;

use App\Models\User;
use Illuminate\Support\Collection;
use JsonException;

class GenerationCacheKey
{
    /**
     * Build a deterministic, owner-scoped fingerprint for a generation request.
     *
     * The request UUID is deliberately excluded: it only protects a single
     * browser submission, while this key protects semantically identical jobs.
     *
     * @param  Collection<int, mixed>  $documents
     *
     * @throws JsonException
     */
    public function make(User $actor, Collection $documents, array $request): string
    {
        $documentSnapshot = $documents
            ->sortBy('id')
            ->values()
            ->map(fn ($document): array => [
                'id' => (int) $document->id,
                'checksum' => (string) ($document->checksum ?? ''),
                'parser' => (string) ($document->parser_name ?? ''),
                'analysis_method' => data_get($document->parser_metadata_json, 'analysis_method'),
            ])
            ->all();

        $requestSnapshot = $request;
        unset($requestSnapshot['request_key'], $requestSnapshot['document_ids']);

        $payload = [
            'center_id' => (int) $actor->center_id,
            // Keep the cache owner-scoped. Teachers may only access their own
            // source documents; this prevents sharing raw source-derived
            // results across teachers without an explicit approved question.
            'requested_by' => (int) $actor->id,
            'documents' => $documentSnapshot,
            'request' => $this->canonicalize($requestSnapshot),
            'provider' => (string) config('services.ai.provider'),
            'model' => (string) config('services.ai.model'),
            'prompt_version' => (string) config('english-ai.prompt_version'),
            'schema_version' => 1,
        ];

        return hash('sha256', json_encode($payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    private function canonicalize(mixed $value, ?string $key = null): mixed
    {
        if (! is_array($value)) {
            return is_string($value) ? trim($value) : $value;
        }

        if (array_is_list($value)) {
            $items = array_map(fn ($item) => $this->canonicalize($item), $value);
            if (in_array($key, ['source_chunk_ids', 'document_ids'], true)) {
                sort($items);

                return array_values($items);
            }

            return $items;
        }

        ksort($value);

        return array_map(
            fn ($item, $itemKey) => $this->canonicalize($item, (string) $itemKey),
            $value,
            array_keys($value),
        );
    }
}
