<?php

namespace App\Enums;

enum QuestionType: string
{
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
    case READING_COMPREHENSION = 'reading_comprehension';
    case LISTENING_QUESTION = 'listening_question';
}
