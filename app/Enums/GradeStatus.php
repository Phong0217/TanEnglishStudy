<?php

namespace App\Enums;

enum GradeStatus: string
{
    case DRAFT = 'DRAFT';
    case GRADED = 'GRADED';
    case RELEASED = 'RELEASED';
    case RETURNED = 'RETURNED';
}
