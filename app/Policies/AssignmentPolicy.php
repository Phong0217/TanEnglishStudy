<?php

namespace App\Policies;

use App\Enums\RoleName;
use App\Models\Assignment;
use App\Models\User;

class AssignmentPolicy
{
    public function delete(User $user, Assignment $assignment): bool
    {
        if ($user->center_id !== $assignment->center_id) {
            return false;
        }

        return $user->hasRole(RoleName::ADMIN->value)
            || ($user->hasRole(RoleName::TEACHER->value) && $assignment->created_by === $user->id);
    }
}
