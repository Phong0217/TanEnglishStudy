<?php

namespace App\Enums;

enum BlockType: string
{
    case SECTION = 'section';
    case HEADING = 'heading';
    case RICH_TEXT = 'rich_text';
    case IMAGE = 'image';
    case AUDIO = 'audio';
    case VIDEO = 'video';
    case FILE = 'file';
    case READING_PASSAGE = 'reading_passage';
    case VOCABULARY = 'vocabulary';
    case GRAMMAR_EXPLANATION = 'grammar_explanation';
    case DIVIDER = 'divider';
    case CALLOUT = 'callout';
    case MULTIPLE_CHOICE = 'multiple_choice';
    case MULTIPLE_SELECT = 'multiple_select';
    case TRUE_FALSE = 'true_false';
    case FILL_BLANK = 'fill_blank';
    case DROPDOWN = 'dropdown';
    case MATCHING = 'matching';
    case ORDERING = 'ordering';
    case DRAG_DROP = 'drag_drop';
    case SHORT_ANSWER = 'short_answer';
    case OPEN_RESPONSE = 'open_response';
    case SPEAKING_PROMPT = 'speaking_prompt';
    case READING_COMPREHENSION = 'reading_comprehension';
    case LISTENING_QUESTION = 'listening_question';
}
