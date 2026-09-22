<?php

namespace App\Enums;

enum RoleName: string
{
    case ADMIN = 'ADMIN';
    case TEACHER = 'TEACHER';
    case STUDENT = 'STUDENT';
}
