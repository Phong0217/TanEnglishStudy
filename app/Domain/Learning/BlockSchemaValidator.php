<?php

namespace App\Domain\Learning;

use App\Enums\BlockType;
use App\Enums\GradingMode;
use Illuminate\Validation\ValidationException;

class BlockSchemaValidator
{
    public function validate(array $block, bool $strict = true): void
    {
        $type = BlockType::tryFrom((string) ($block['block_type'] ?? ''));
        if (! $type) {
            throw ValidationException::withMessages(['block_type' => 'The selected block type is invalid.']);
        }
        $content = $block['content_json'] ?? [];
        $answer = $block['answer_key_json'] ?? [];
        $settings = $block['settings_json'] ?? [];

        match ($type) {
            BlockType::SECTION => $this->validateSection($content, $strict),
            BlockType::HEADING => $this->requireText($content, 'text'),
            BlockType::RICH_TEXT => $this->requireText($content, 'html'),
            BlockType::READING_PASSAGE => $this->requireAnyText($content, ['passage', 'html']),
            BlockType::GRAMMAR_EXPLANATION => $this->requireAnyText($content, ['explanation', 'html']),
            BlockType::IMAGE, BlockType::AUDIO, BlockType::VIDEO, BlockType::FILE => $this->requirePositiveId($content, 'mediaAssetId'),
            BlockType::VOCABULARY => $this->validateVocabulary($content),
            BlockType::CALLOUT => $this->requireText($content, 'text'),
            BlockType::DIVIDER => null,
            BlockType::MULTIPLE_CHOICE => $this->validateChoice($content, $answer, 3, 5, false),
            BlockType::MULTIPLE_SELECT => $this->validateChoice($content, $answer, 4, 6, true),
            BlockType::TRUE_FALSE => $this->validateTrueFalse($content, $answer),
            BlockType::FILL_BLANK => $this->validateFillBlank($content, $answer),
            BlockType::DROPDOWN => $this->validateDropdown($content, $answer),
            BlockType::MATCHING => $this->validateMatching($content, $answer),
            BlockType::ORDERING => $this->validateOrdering($content, $answer),
            BlockType::DRAG_DROP => $this->validateDragDrop($content, $answer),
            BlockType::SHORT_ANSWER => $this->validateShortAnswer($content, $answer, $block, $settings),
            BlockType::OPEN_RESPONSE => $this->validateOpenResponse($content, $block),
            BlockType::SPEAKING_PROMPT => $this->validateOpenResponse($content, $block),
            BlockType::READING_COMPREHENSION => $this->validateReading($content, $answer),
            BlockType::LISTENING_QUESTION => $this->validateListening($content, $strict),
        };

        if ((float) ($block['points'] ?? 0) < 0) {
            throw ValidationException::withMessages(['points' => 'Points cannot be negative.']);
        }
    }

    private function validateSection(array $content, bool $strict): void
    {
        $this->requireText($content, 'title');
        $children = $content['children'] ?? [];
        if (! is_array($children)) {
            throw ValidationException::withMessages(['content_json.children' => 'Section children must be an array.']);
        }
        if ($strict && count($children) < 1) {
            throw ValidationException::withMessages(['content_json.children' => 'Add at least one block to this section before publishing.']);
        }
        $positions = [];
        foreach ($children as $index => $child) {
            if (! is_array($child)) {
                throw ValidationException::withMessages(["content_json.children.{$index}" => 'Invalid child block.']);
            }
            $child['position'] = $child['position'] ?? $index + 1;
            $positions[] = (int) $child['position'];
            if (($child['block_type'] ?? null) === BlockType::SECTION->value) {
                throw ValidationException::withMessages(["content_json.children.{$index}" => 'Nested sections are not supported.']);
            }
            try {
                $this->validate($child, $strict);
            } catch (ValidationException $e) {
                throw ValidationException::withMessages(["content_json.children.{$index}" => collect($e->errors())->flatten()->first()]);
            }
        }
        if (count($positions) !== count(array_unique($positions))) {
            throw ValidationException::withMessages(['content_json.children' => 'Section child positions must be unique.']);
        }
    }

    private function requireText(array $data, string $key): void
    {
        if (! is_string($data[$key] ?? null) || trim(strip_tags($data[$key])) === '') {
            throw ValidationException::withMessages(["content_json.{$key}" => 'This content is required.']);
        }
    }

    private function requireAnyText(array $data, array $keys): void
    {
        foreach ($keys as $key) {
            if (is_string($data[$key] ?? null) && trim(strip_tags($data[$key])) !== '') {
                return;
            }
        }

        throw ValidationException::withMessages(['content_json' => 'This content is required.']);
    }

    private function requirePositiveId(array $data, string $key): void
    {
        $value = $data[$key] ?? null;
        if ((is_string($value) && ! ctype_digit($value)) || (! is_int($value) && ! is_string($value)) || (int) $value < 1) {
            throw ValidationException::withMessages(["content_json.{$key}" => 'A ready private media asset is required.']);
        }
    }

    private function requireMediaReference(array $data, string $path = 'media_id'): void
    {
        $value = $data['image_media_id'] ?? $data['imageMediaId'] ?? $data['mediaAssetId'] ?? $data['media_id'] ?? null;
        if ((is_string($value) && ! ctype_digit($value)) || (! is_int($value) && ! is_string($value)) || (int) $value < 1) {
            throw ValidationException::withMessages(["content_json.{$path}" => 'An uploaded image is required for this answer.']);
        }
    }

    private function prompt(array $content): void
    {
        $this->requireText($content, 'prompt');
    }

    private function uniqueIds(array $items, string $path): array
    {
        $ids = array_map(fn ($item) => $item['id'] ?? null, $items);
        $missing = [];
        foreach ($ids as $index => $id) {
            if (! is_scalar($id) || trim((string) $id) === '') {
                $missing[] = $index + 1;
            }
        }
        if ($missing) {
            throw ValidationException::withMessages([$path => 'Every item needs a unique ID. Missing ID at item(s): '.implode(', ', $missing).'.']);
        }

        $normalized = array_map(static fn ($id) => (string) $id, $ids);
        $counts = array_count_values($normalized);
        $duplicates = array_keys(array_filter($counts, static fn (int $count) => $count > 1));
        if ($duplicates) {
            throw ValidationException::withMessages([$path => 'Every item needs a unique ID. Duplicate ID(s): '.implode(', ', $duplicates).'.']);
        }

        return $ids;
    }

    private function validateVocabulary(array $content): void
    {
        $items = $content['items'] ?? [];
        if (count($items) < 1) {
            throw ValidationException::withMessages(['content_json.items' => 'Add at least one vocabulary item.']);
        } $this->uniqueIds($items, 'content_json.items');
        foreach ($items as $item) {
            $this->requireText($item, 'term');
            $this->requireText($item, 'definition');
        }
    }

    private function validateChoice(array $content, array $answer, int $min, int $max, bool $multiple, ?string $displayType = null): void
    {
        $this->prompt($content);
        $options = $content['options'] ?? [];
        if (count($options) < $min || count($options) > $max) {
            throw ValidationException::withMessages(['content_json.options' => "Add {$min} to {$max} options."]);
        }$ids = $this->uniqueIds($options, 'content_json.options');
        foreach ($options as $option) {
            if ($displayType === 'image') {
                $this->requireMediaReference($option);
            } elseif ($displayType === 'image_text') {
                $this->requireText($option, 'text');
                $this->requireMediaReference($option);
            } else {
                $this->requireText($option, 'text');
            }
        }$correct = $multiple ? ($answer['correctOptionIds'] ?? []) : [$answer['correctOptionId'] ?? null];
        if ($multiple && count($correct) < 2) {
            throw ValidationException::withMessages(['answer_key_json.correctOptionIds' => 'Select at least two correct answers.']);
        }if ($multiple && count($correct) >= count($options)) {
            throw ValidationException::withMessages(['answer_key_json.correctOptionIds' => 'At least one option must be incorrect.']);
        }if (count(array_unique($correct)) !== count($correct) || array_diff($correct, $ids)) {
            throw ValidationException::withMessages(['answer_key_json' => 'Correct answers must reference unique option IDs.']);
        }
    }

    private function validateTrueFalse(array $content, array $answer): void
    {
        $this->prompt($content);
        if (! is_bool($answer['correct'] ?? null)) {
            throw ValidationException::withMessages(['answer_key_json.correct' => 'A boolean answer is required.']);
        }
    }

    private function validateFillBlank(array $content, array $answer): void
    {
        $this->prompt($content);
        if (! str_contains($content['prompt'], '{{blank}}')) {
            throw ValidationException::withMessages(['content_json.prompt' => 'Include at least one {{blank}} marker.']);
        }if (! is_array($answer['acceptedAnswers'] ?? null) || count(array_filter($answer['acceptedAnswers'], fn ($v) => is_string($v) && trim($v) !== '')) < 1) {
            throw ValidationException::withMessages(['answer_key_json.acceptedAnswers' => 'Add at least one accepted answer.']);
        }
    }

    private function validateDropdown(array $content, array $answer): void
    {
        $this->prompt($content);
        $blanks = $content['blanks'] ?? [];
        if (! $blanks) {
            throw ValidationException::withMessages(['content_json.blanks' => 'Add at least one named blank.']);
        }$ids = $this->uniqueIds($blanks, 'content_json.blanks');
        foreach ($blanks as $blank) {
            if (count($blank['options'] ?? []) < 2) {
                throw ValidationException::withMessages(['content_json.blanks' => 'Each blank needs at least two options.']);
            }if (! in_array($answer['answers'][$blank['id']] ?? null, array_column($blank['options'], 'id'), true)) {
                throw ValidationException::withMessages(['answer_key_json.answers' => 'Each blank needs one valid correct option.']);
            }
        }
    }

    private function validateMatching(array $content, array $answer): void
    {
        $this->prompt($content);
        $pairs = $content['pairs'] ?? [];
        if (count($pairs) < 2) {
            throw ValidationException::withMessages(['content_json.pairs' => 'Add at least two pairs.']);
        }$ids = $this->uniqueIds($pairs, 'content_json.pairs');
        foreach ($pairs as $pair) {
            $this->requireText($pair, 'left');
            $this->requireText($pair, 'right');
        }if (array_diff($ids, array_keys($answer['matches'] ?? []))) {
            throw ValidationException::withMessages(['answer_key_json.matches' => 'Every pair must have a mapping.']);
        }
    }

    private function validateOrdering(array $content, array $answer): void
    {
        $this->prompt($content);
        $items = $content['items'] ?? [];
        if (count($items) < 3) {
            throw ValidationException::withMessages(['content_json.items' => 'Add at least three items.']);
        }$ids = $this->uniqueIds($items, 'content_json.items');
        $order = $answer['correctOrder'] ?? [];
        if (count($order) !== count($ids) || array_diff($ids, $order) || count($order) !== count(array_unique($order))) {
            throw ValidationException::withMessages(['answer_key_json.correctOrder' => 'The order must include every item exactly once.']);
        }
    }

    private function validateDragDrop(array $content, array $answer): void
    {
        $this->prompt($content);
        $items = $content['items'] ?? [];
        $targets = $content['targets'] ?? [];
        if (! $items || ! $targets) {
            throw ValidationException::withMessages(['content_json' => 'Draggable items and targets are required.']);
        }$itemIds = $this->uniqueIds($items, 'content_json.items');
        $targetIds = $this->uniqueIds($targets, 'content_json.targets');
        foreach (($answer['mapping'] ?? []) as $item => $target) {
            if (! in_array($item, $itemIds, true) || ! in_array($target, $targetIds, true)) {
                throw ValidationException::withMessages(['answer_key_json.mapping' => 'Every mapping must reference an existing item and target.']);
            }
        }if (array_diff($itemIds, array_keys($answer['mapping'] ?? []))) {
            throw ValidationException::withMessages(['answer_key_json.mapping' => 'Every draggable item needs a target.']);
        }
    }

    private function validateShortAnswer(array $content, array $answer, array $block, array $settings): void
    {
        $this->prompt($content);
        if (($block['grading_mode'] ?? 'AUTO') === GradingMode::AUTO->value && empty($answer['acceptedAnswers'])) {
            throw ValidationException::withMessages(['answer_key_json.acceptedAnswers' => 'Auto-graded short answers require unambiguous accepted answers.']);
        }
    }

    private function validateOpenResponse(array $content, array $block): void
    {
        $this->prompt($content);
        if (empty($block['rubric'] ?? $block['answer_key_json']['rubric'] ?? $block['settings_json']['rubric'] ?? null)) {
            throw ValidationException::withMessages(['rubric' => 'A rubric is required.']);
        }if (($block['grading_mode'] ?? '') === GradingMode::AUTO->value) {
            throw ValidationException::withMessages(['grading_mode' => 'Open responses require teacher or AI-assisted grading.']);
        }
    }

    private function validateComposite(array $content, string $source): void
    {
        $this->requireText($content, $source);
        if (empty($content['interactionType'])) {
            throw ValidationException::withMessages(['content_json.interactionType' => 'Choose an interaction type.']);
        }
    }

    private function validateReading(array $content, array $answer): void
    {
        $this->requireText($content, 'passage');
        if (! isset($content['questions'])) {
            if (empty($content['interactionType'])) {
                throw ValidationException::withMessages(['content_json.interactionType' => 'Choose an interaction type.']);
            }
            return;
        }

        $questions = $content['questions'];
        if (! is_array($questions) || count($questions) < 1) {
            throw ValidationException::withMessages(['content_json.questions' => 'Add at least one reading question.']);
        }
        $this->uniqueIds($questions, 'content_json.questions');
        foreach ($questions as $question) {
            $type = (string) ($question['type'] ?? '');
            $questionContent = $question['content'] ?? $question;
            $questionAnswer = $question['answer_key'] ?? [];
            if (! is_array($questionContent) || ! is_array($questionAnswer)) {
                throw ValidationException::withMessages(['content_json.questions' => 'Invalid reading question.']);
            }
            match ($type) {
                'multiple_choice', 'image_choice' => $this->validateChoice($questionContent, $questionAnswer, 2, 6, false, $type === 'image_choice' ? 'image' : (string) ($question['answer_display_type'] ?? $questionContent['answer_display_type'] ?? 'text')),
                'multiple_select' => $this->validateChoice($questionContent, $questionAnswer, 2, 6, true, (string) ($question['answer_display_type'] ?? $questionContent['answer_display_type'] ?? 'text')),
                'true_false' => $this->validateTrueFalse($questionContent, $questionAnswer),
                'fill_blank' => $this->validateFillBlank($questionContent, $questionAnswer),
                'dropdown' => $this->validateDropdown($questionContent, $questionAnswer),
                default => throw ValidationException::withMessages(['content_json.questions' => 'Unsupported reading question type.']),
            };
        }
    }

    private function validateListening(array $content, bool $strict = true): void
    {
        if (isset($content['questions'])) {
            $audioAssetId = $content['audioAssetId'] ?? null;
            if ((is_string($audioAssetId) && ! ctype_digit($audioAssetId)) || (! is_int($audioAssetId) && ! is_string($audioAssetId)) || (int) $audioAssetId < 1) {
                if (! $strict) return;
                throw ValidationException::withMessages(['content_json.audioAssetId' => 'Listening blocks require an uploaded audio file.']);
            }
            $questions = $content['questions'];
            if (! is_array($questions) || count($questions) < 1) {
                if (! $strict) return;
                throw ValidationException::withMessages(['content_json.questions' => 'Add at least one listening question.']);
            }
            $ids = $this->uniqueIds($questions, 'content_json.questions');
            if (! empty($content['illustration_media_id']) || ! empty($content['illustrationMediaId'])) {
                $this->requireMediaReference(['media_id' => $content['illustration_media_id'] ?? $content['illustrationMediaId']], 'illustration_media_id');
            }
            if (! empty($content['example']['enabled'])) {
                $this->validateListeningExample($content['example']);
            }
            foreach ($questions as $question) {
                $this->validateListeningQuestion($question);
            }
            return;
        }
        if (empty($content['audioAssetId']) && empty($content['transcript'])) {
            if (! $strict) return;
            throw ValidationException::withMessages(['content_json' => 'Listening questions require audio or a transcript.']);
        }if (empty($content['interactionType'])) {
            throw ValidationException::withMessages(['content_json.interactionType' => 'Choose an interaction type.']);
        }
    }

    private function validateListeningQuestion(array $question): void
    {
        $type = (string) ($question['type'] ?? '');
        $content = $question['content'] ?? $question;
        $answer = $question['answer_key'] ?? [];
        if (! in_array($type, ['multiple_choice', 'multiple_select', 'true_false', 'image_choice', 'fill_blank', 'dropdown'], true)) {
            throw ValidationException::withMessages(['content_json.questions' => 'Unsupported listening question type.']);
        }
        $displayType = (string) ($question['answer_display_type'] ?? $content['answer_display_type'] ?? ($type === 'image_choice' ? 'image' : 'text'));
        if (! in_array($displayType, ['text', 'image', 'image_text'], true)) {
            throw ValidationException::withMessages(['content_json.questions' => 'Choose a valid listening answer display type.']);
        }
        match ($type) {
            'multiple_choice', 'image_choice' => $this->validateChoice($content, $answer, 2, 6, false, $displayType),
            'multiple_select' => $this->validateChoice($content, $answer, 2, 6, true, $displayType),
            'true_false' => $this->validateTrueFalse($content, $answer),
            'fill_blank' => $this->validateFillBlank($content, $answer),
            'dropdown' => $this->validateDropdown($content, $answer),
        };
    }

    private function validateListeningExample(array $example): void
    {
        $question = ['type' => 'multiple_choice', 'content' => [
            'prompt' => $example['question'] ?? '',
            'options' => $example['options'] ?? [],
            'answer_display_type' => $example['answer_display_type'] ?? 'text',
        ], 'answer_key' => ['correctOptionId' => $example['correctOptionId'] ?? null]];
        $this->validateListeningQuestion($question);
        if (! empty($example['question_image_media_id']) || ! empty($example['questionImageMediaId'])) {
            $this->requireMediaReference(['media_id' => $example['question_image_media_id'] ?? $example['questionImageMediaId']], 'example_image_media_id');
        }
    }
}
