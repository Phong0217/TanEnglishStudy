<?php

namespace App\Enums;

enum SubmissionStatus: string
{
    case NOT_STARTED = 'NOT_STARTED';
    case IN_PROGRESS = 'IN_PROGRESS';
    case SUBMITTED = 'SUBMITTED';
    case LATE = 'LATE';
    case GRADED = 'GRADED';
    case RETURNED = 'RETURNED';
}
