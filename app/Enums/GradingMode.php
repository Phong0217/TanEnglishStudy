<?php

namespace App\Enums;

enum GradingMode: string
{
    case AUTO = 'AUTO';
    case TEACHER = 'TEACHER';
    case AI_ASSISTED = 'AI_ASSISTED';
}
