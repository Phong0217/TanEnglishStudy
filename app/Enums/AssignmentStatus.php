<?php

namespace App\Enums;

enum AssignmentStatus: string
{
    case DRAFT = 'DRAFT';
    case SCHEDULED = 'SCHEDULED';
    case PUBLISHED = 'PUBLISHED';
    case CLOSED = 'CLOSED';
    case ARCHIVED = 'ARCHIVED';
}
