<?php

namespace Tests\Unit;

use App\Domain\AI\EnglishQuestionValidator;
use App\Domain\Documents\EnglishDocumentChunks;
use App\Domain\AI\GenerationBlueprint;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class EnglishQuestionGenerationTest extends TestCase
{
    public function test_blueprint_requires_each_distribution_to_match_total(): void
    {
        $input = ['number_of_questions' => 3, 'type_counts' => ['multiple_choice' => 2], 'difficulty_counts' => ['EASY' => 3], 'category_counts' => ['reading' => 3]];
        $this->expectException(ValidationException::class);
        app(GenerationBlueprint::class)->validate($input);
    }

    public function test_blueprint_expands_deterministic_slots(): void
    {
        $input = ['number_of_questions' => 3, 'type_counts' => ['multiple_choice' => 2, 'short_answer' => 1], 'difficulty_counts' => ['EASY' => 1, 'MEDIUM' => 2], 'category_counts' => ['reading' => 2, 'grammar' => 1]];
        $slots = app(GenerationBlueprint::class)->slots($input);
        $this->assertCount(3, $slots);
        $this->assertSame(['multiple_choice', 'multiple_choice', 'short_answer'], array_column($slots, 'type'));
    }


    public function test_exact_mode_uses_question_count_without_blueprint_distribution(): void
    {
        $slots = app(GenerationBlueprint::class)->slots(['source_mode' => 'extract_exact', 'number_of_questions' => 4]);
        $this->assertCount(4, $slots);
        $this->assertTrue(collect($slots)->every(fn ($slot) => $slot['type'] === 'multiple_choice'));
    }

    public function test_exact_mode_slots_follow_selected_source_scope(): void
    {
        $slots = app(GenerationBlueprint::class)->slots(['source_mode' => 'extract_exact', 'source_scope' => 'writing', 'number_of_questions' => 2]);
        $this->assertSame(['writing', 'writing'], array_column($slots, 'category'));
    }

    public function test_exact_schema_does_not_constrain_difficulty(): void
    {
        $schema = \App\Domain\AI\QuestionGenerationSchema::definition(['source_mode' => 'extract_exact']);
        $difficulty = $schema['properties']['questions']['items']['properties']['difficulty'];

        $this->assertSame(['type' => 'string'], $difficulty);
    }

    public function test_document_chunks_preserve_activity_and_reading_passage_groups(): void
    {
        $chunks = app(EnglishDocumentChunks::class)->build([[
            'number' => 1,
            'text' => "A- VOCABULARY & GRAMMAR
1. Choose the best answer.
B- READING
Read the following passage about schools.
23. What is the main idea?
24. Which statement is true?
C- WRITING
36. Choose the best sentence.",
        ]]);
        $groups = array_column(array_column($chunks, 'metadata_json'), 'activity_type');
        $this->assertContains('VOCABULARY_GRAMMAR', $groups);
        $this->assertContains('READING', $groups);
        $this->assertContains('WRITING', $groups);
        $reading = array_values(array_filter($chunks, fn ($chunk) => ($chunk['metadata_json']['activity_type'] ?? null) === 'READING'));
        $this->assertNotEmpty($reading);
        $this->assertSame('reading', $reading[0]['metadata_json']['group_key']);
        $this->assertSame('reading:p1', $reading[0]['metadata_json']['passage_key']);
    }

    public function test_ai_prompt_normalizer_removes_embedded_multiple_choice_options(): void
    {
        $prompt = app(\App\Domain\Learning\QuestionPromptNormalizer::class)->normalize(
            'Question 8 The ____ of traditional crafts is essential to keep our local culture alive for future generations. A. preserve B. preservable C. preservation D. preserver'
        );

        $this->assertSame('The ____ of traditional crafts is essential to keep our local culture alive for future generations.', $prompt);
    }

    public function test_duplicate_detection_normalizes_question_text(): void
    {
        $validator = app(EnglishQuestionValidator::class);
        $this->assertTrue($validator->duplicate('What does volunteer mean?', ['What does “VOLUNTEER” mean?']));
        $this->assertFalse($validator->duplicate('Choose the past tense of visit.', ['What does volunteer mean?']));
    }
}
