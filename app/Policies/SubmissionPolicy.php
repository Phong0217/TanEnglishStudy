<?php

namespace App\Policies;

use App\Enums\RoleName;
use App\Models\Submission;
use App\Models\User;

class SubmissionPolicy
{
    public function view(User $user, Submission $submission): bool
    {
        $classroom = $submission->delivery->classroom;
        if ($user->center_id !== $classroom->center_id) {
            return false;
        }if ($user->hasRole(RoleName::ADMIN->value)) {
            return true;
        }if ($user->hasRole(RoleName::STUDENT->value)) {
            return $submission->student_id === $user->id;
        }

        return $classroom->teacherAssignments()->where('teacher_id', $user->id)->where('status', 'ACTIVE')->exists();
    }

    public function grade(User $user, Submission $submission): bool
    {
        return $this->view($user, $submission) && ! $user->hasRole(RoleName::STUDENT->value);
    }
}
