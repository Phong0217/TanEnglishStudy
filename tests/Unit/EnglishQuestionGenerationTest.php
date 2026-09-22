<?php

namespace Tests\Unit;

use App\Domain\AI\EnglishQuestionValidator;
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

    public function test_duplicate_detection_normalizes_question_text(): void
    {
        $validator = app(EnglishQuestionValidator::class);
        $this->assertTrue($validator->duplicate('What does volunteer mean?', ['What does “VOLUNTEER” mean?']));
        $this->assertFalse($validator->duplicate('Choose the past tense of visit.', ['What does volunteer mean?']));
    }
}
