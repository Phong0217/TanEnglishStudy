<?php

namespace App\Policies;

use App\Enums\RoleName;
use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    private function centerId(Lesson $lesson): int
    {
        return (int) $lesson->creator()->value('center_id');
    }

    public function view(User $user, Lesson $lesson): bool
    {
        if ($user->center_id !== $this->centerId($lesson)) return false;
        if ($user->hasRole(RoleName::ADMIN->value)) return true;
        if ($user->hasRole(RoleName::TEACHER->value)) return $lesson->created_by === $user->id;

        return $lesson->status->value === 'PUBLISHED'
            && $lesson->assignments()->whereHas('versions.deliveries.classroom.enrollments', fn ($q) => $q->where('student_id', $user->id)->where('status', 'ACTIVE'))->exists();
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $this->view($user, $lesson) && ($user->hasRole(RoleName::ADMIN->value) || $lesson->created_by === $user->id);
    }

    public function publish(User $user, Lesson $lesson): bool
    {
        return $this->update($user, $lesson) && $user->can('lessons.publish');
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $this->update($user, $lesson);
    }
}
