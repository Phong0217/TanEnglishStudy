<?php

namespace App\Enums;

enum LogService: string
{
    case AUTH = 'AUTH';
    case USER = 'USER';
    case CLASSROOM = 'CLASS';
    case COURSE = 'COURSE';
    case LESSON = 'LESSON';
    case LESSON_BUILDER = 'LESSON_BUILDER';
    case ASSIGNMENT = 'ASSIGNMENT';
    case QUESTION_BANK = 'QUESTION_BANK';
    case AI_GENERATION = 'AI_GENERATION';
    case DOCUMENT_IMPORT = 'DOCUMENT_IMPORT';
    case MEDIA = 'MEDIA';
    case SUBMISSION = 'SUBMISSION';
    case ATTEMPT = 'ATTEMPT';
    case GRADING = 'GRADING';
    case RESULT = 'RESULT';
    case REPORT = 'REPORT';
    case QUEUE = 'QUEUE';
    case DATABASE = 'DATABASE';
    case EXTERNAL_API = 'EXTERNAL_API';
    case SYSTEM = 'SYSTEM';
}
