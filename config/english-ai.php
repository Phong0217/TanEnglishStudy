<?php

use App\Enums\QuestionType;

return [
    'types' => [QuestionType::MULTIPLE_CHOICE->value => 'Single select', QuestionType::MULTIPLE_SELECT->value => 'Multi select', QuestionType::SHORT_ANSWER->value => 'Text input'],
    'categories' => ['vocabulary' => 'Vocabulary', 'grammar' => 'Grammar', 'reading' => 'Reading', 'sentence_completion' => 'Sentence completion', 'word_form' => 'Word form', 'error_correction' => 'Error correction', 'functional_language' => 'Functional language'],
    'difficulties' => ['EASY' => 'Easy', 'MEDIUM' => 'Medium', 'HARD' => 'Hard'],
    'prompt_version' => 'english-question-generator-v1',
    'queue_connection' => env('AI_QUEUE_CONNECTION', 'database'),
    'batch_size' => 5,
    'max_attempts' => 3,
];
