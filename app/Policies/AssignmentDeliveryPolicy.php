<?php

namespace App\Policies;

use App\Enums\RoleName;
use App\Models\AssignmentDelivery;
use App\Models\User;

class AssignmentDeliveryPolicy
{
    public function view(User $user, AssignmentDelivery $delivery): bool
    {
        $classroom = $delivery->classroom;
        if ($user->center_id !== $classroom->center_id) {
            return false;
        }if ($user->hasRole(RoleName::ADMIN->value)) {
            return true;
        }if ($user->hasRole(RoleName::TEACHER->value)) {
            return $classroom->teacherAssignments()->where('teacher_id', $user->id)->where('status', 'ACTIVE')->exists();
        }

        return $classroom->enrollments()->where('student_id', $user->id)->where('status', 'ACTIVE')->exists();
    }
}
