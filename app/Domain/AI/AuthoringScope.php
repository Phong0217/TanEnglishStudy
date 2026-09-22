<?php

namespace App\Domain\AI;

use App\Models\AiGenerationJob;
use App\Models\CourseVersion;
use App\Models\Question;
use App\Models\SourceDocument;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class AuthoringScope
{
    public function versions(User $user): Builder
    {
        $query = CourseVersion::whereHas('course', fn ($q) => $q->where('center_id', $user->center_id));
        if (! $user->hasRole('ADMIN')) {
            $query->whereHas('classrooms', fn ($q) => $q->where('center_id', $user->center_id)
                ->whereHas('teacherAssignments', fn ($q) => $q->where('teacher_id', $user->id)->where('status', 'ACTIVE')));
        }

        return $query;
    }

    public function documents(User $user): Builder
    {
        $query = SourceDocument::where('center_id', $user->center_id);
        if (! $user->hasRole('ADMIN')) {
            $query->where('uploaded_by', $user->id)->whereIn('course_version_id', $this->versions($user)->select('id'));
        }

        return $query;
    }

    public function jobs(User $user): Builder
    {
        $query = AiGenerationJob::where('center_id', $user->center_id);
        if (! $user->hasRole('ADMIN')) {
            $query->where('requested_by', $user->id)->whereDoesntHave('documents', fn ($q) => $q->whereNotIn('id', $this->documents($user)->select('id')));
        }

        return $query;
    }

    public function questions(User $user): Builder
    {
        $query = Question::where('center_id', $user->center_id);
        if (! $user->hasRole('ADMIN')) {
            $query->where(fn ($q) => $q->whereNull('course_version_id')->where('created_by', $user->id)
                ->orWhereIn('course_version_id', $this->versions($user)->select('id')))
                ->where(fn ($q) => $q->where('created_by', $user->id)->orWhere('status', 'APPROVED'));
        }

        return $query;
    }
}
