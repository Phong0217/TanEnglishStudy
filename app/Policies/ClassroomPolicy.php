<?php

namespace App\Policies;

use App\Enums\RoleName;
use App\Models\Classroom;
use App\Models\User;

class ClassroomPolicy
{
    public function view(User $user, Classroom $classroom): bool
    {
        if ($user->center_id !== $classroom->center_id) {
            return false;
        }if ($user->hasRole(RoleName::ADMIN->value)) {
            return true;
        }if ($user->hasRole(RoleName::TEACHER->value)) {
            return $classroom->teacherAssignments()->where('teacher_id', $user->id)->where('status', 'ACTIVE')->exists();
        }

        return $classroom->enrollments()->where('student_id', $user->id)->where('status', 'ACTIVE')->exists();
    }

    public function update(User $user, Classroom $classroom): bool
    {
        return $user->center_id === $classroom->center_id && $user->hasRole(RoleName::ADMIN->value);
    }
}
