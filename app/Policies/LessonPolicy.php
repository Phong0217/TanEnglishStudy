<?php

namespace App\Policies;

use App\Enums\RoleName;
use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    private function centerId(Lesson $lesson): int
    {
        return $lesson->unit->courseVersion->course->center_id;
    }

    public function view(User $user, Lesson $lesson): bool
    {
        if ($user->center_id !== $this->centerId($lesson)) {
            return false;
        }if ($user->hasRole(RoleName::ADMIN->value)) {
            return true;
        }$versionId = $lesson->unit->course_version_id;
        if ($user->hasRole(RoleName::TEACHER->value)) {
            return $user->teachingAssignments()->where('status', 'ACTIVE')->whereHas('classroom', fn ($q) => $q->where('course_version_id', $versionId))->exists();
        }

        return $lesson->status->value === 'PUBLISHED' && $user->enrollments()->where('status', 'ACTIVE')->whereHas('classroom', fn ($q) => $q->where('course_version_id', $versionId))->exists();
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $this->view($user, $lesson) && ($user->hasRole(RoleName::ADMIN->value) || $lesson->created_by === $user->id || ($user->hasRole(RoleName::TEACHER->value) && $user->teachingAssignments()->where('status', 'ACTIVE')->whereHas('classroom', fn ($q) => $q->where('course_version_id', $lesson->unit->course_version_id))->exists()));
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
