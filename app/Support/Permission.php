<?php

namespace App\Support;

final class Permission
{
    public const DASHBOARD_ADMIN = 'dashboard.admin';

    public const DASHBOARD_TEACHER = 'dashboard.teacher';

    public const DASHBOARD_STUDENT = 'dashboard.student';

    public const USERS_MANAGE = 'users.manage';

    public const CLASSROOMS_MANAGE = 'classrooms.manage';

    public const COURSES_MANAGE = 'courses.manage';

    public const LESSONS_AUTHOR = 'lessons.author';

    public const LESSONS_PUBLISH = 'lessons.publish';

    public const ASSIGNMENTS_AUTHOR = 'assignments.author';

    public const ASSIGNMENTS_DELIVER = 'assignments.deliver';

    public const SUBMISSIONS_OWN = 'submissions.own';

    public const SUBMISSIONS_GRADE = 'submissions.grade';

    public const GRADES_OWN = 'grades.own';

    public const QUESTIONS_MANAGE = 'questions.manage';

    public const DOCUMENTS_MANAGE = 'documents.manage';

    public const AI_GENERATE = 'ai.generate';

    public const REPORTS_VIEW = 'reports.view';

    public const AUDIT_VIEW = 'audit.view';

    public const SETTINGS_MANAGE = 'settings.manage';

    public static function all(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
