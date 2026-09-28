<?php

namespace Tests\Unit;

use App\Domain\AI\GenerationCacheKey;
use App\Models\SourceDocument;
use App\Models\User;
use Illuminate\Support\Collection;
use Tests\TestCase;

class GenerationCacheKeyTest extends TestCase
{
    public function test_equivalent_requests_have_the_same_cache_key(): void
    {
        $actor = new User;
        $actor->id = 7;
        $actor->center_id = 3;

        $first = new SourceDocument;
        $first->id = 2;
        $first->checksum = str_repeat('b', 64);
        $first->parser_name = 'pdf';
        $first->parser_metadata_json = ['analysis_method' => 'section-headings-v2'];

        $second = new SourceDocument;
        $second->id = 1;
        $second->checksum = str_repeat('a', 64);
        $second->parser_name = 'pdf';
        $second->parser_metadata_json = ['analysis_method' => 'section-headings-v2'];

        $request = [
            'document_ids' => [2, 1],
            'request_key' => 'different-request-id',
            'number_of_questions' => 5,
            'source_mode' => 'generated',
            'source_scope' => 'all',
            'type_counts' => ['short_answer' => 2, 'multiple_choice' => 3],
            'difficulty_counts' => ['HARD' => 1, 'EASY' => 4],
            'category_counts' => ['reading' => 5],
            'additional_constraints' => '  Keep the original order.  ',
        ];

        $equivalent = $request;
        $equivalent['document_ids'] = [1, 2];
        $equivalent['request_key'] = 'another-request-id';
        $equivalent['type_counts'] = ['multiple_choice' => 3, 'short_answer' => 2];
        $equivalent['difficulty_counts'] = ['EASY' => 4, 'HARD' => 1];

        $service = app(GenerationCacheKey::class);

        $this->assertSame(
            $service->make($actor, new Collection([$first, $second]), $request),
            $service->make($actor, new Collection([$second, $first]), $equivalent),
        );
    }

    public function test_cache_key_changes_when_model_or_source_changes(): void
    {
        $actor = new User;
        $actor->id = 7;
        $actor->center_id = 3;

        $document = new SourceDocument;
        $document->id = 1;
        $document->checksum = str_repeat('a', 64);
        $document->parser_name = 'pdf';
        $document->parser_metadata_json = ['analysis_method' => 'section-headings-v2'];

        $request = [
            'document_ids' => [1],
            'request_key' => 'request-id',
            'number_of_questions' => 1,
            'source_mode' => 'extract_exact',
            'source_scope' => 'all',
        ];

        $service = app(GenerationCacheKey::class);
        $original = $service->make($actor, new Collection([$document]), $request);

        $document->checksum = str_repeat('c', 64);
        $changedSource = $service->make($actor, new Collection([$document]), $request);

        $this->assertNotSame($original, $changedSource);
    }
}
