<?php

use App\Http\Controllers\Admin\ClassroomController as AdminClassroomController;
use App\Http\Controllers\Admin\CenterSettingsController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AiGenerationController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ClassroomViewerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EnglishQuestionReviewController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MediaAssetController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Student\StudentContentController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\StudentImportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => auth()->check() ? redirect()->route(strtolower(auth()->user()->getRoleNames()->first()).'.dashboard') : redirect()->route('login'));
Route::get('/dashboard', fn () => redirect()->route(strtolower(auth()->user()->getRoleNames()->first()).'.dashboard'))->middleware(['auth', 'active'])->name('dashboard');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/media-assets/{mediaAsset}/stream', [MediaAssetController::class, 'stream'])->name('media-assets.stream');
    Route::get('/center/logo', [CenterSettingsController::class, 'logo'])->name('center.logo');
    foreach (['admin' => 'ADMIN', 'teacher' => 'TEACHER'] as $prefix => $role) {
        Route::prefix($prefix)->name($prefix.'.')->middleware('primary-role:'.$role)->group(function () {
            Route::post('/ai-documents', [DocumentController::class, 'uploadMany'])->middleware('throttle:10,1')->name('ai.documents');
            Route::get('/ai-jobs/{job}/review', [AiGenerationController::class, 'show'])->name('ai.review');
            Route::post('/ai-jobs/{job}/retry', [AiGenerationController::class, 'retry'])->middleware('throttle:5,1')->name('ai.retry');
            Route::post('/ai-questions/bulk', [EnglishQuestionReviewController::class, 'bulk'])->name('ai.questions.bulk');
            Route::patch('/ai-questions/{question}', [EnglishQuestionReviewController::class, 'update'])->name('ai.questions.update');
            Route::post('/ai-questions/{question}/regenerate', [EnglishQuestionReviewController::class, 'regenerate'])->middleware('throttle:5,1')->name('ai.questions.regenerate');
        });
    }
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}', [NotificationController::class, 'read'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read-all');

    Route::prefix('admin')->name('admin.')->middleware('primary-role:ADMIN')->group(function () {
        Route::post('/media/audio', [MediaAssetController::class, 'storeAudio'])->name('media.audio.store');
        Route::post('/media/image', [MediaAssetController::class, 'storeImage'])->name('media.image.store');
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::get('/settings/center', [CenterSettingsController::class, 'edit'])->name('settings.center');
        Route::post('/settings/center', [CenterSettingsController::class, 'update'])->name('settings.center.update');
        Route::get('/teachers', fn (Request $request) => app(AdminUserController::class)->index($request, 'TEACHER'))->name('teachers.index');
        Route::get('/students', fn (Request $request) => app(AdminUserController::class)->index($request, 'STUDENT'))->name('students.index');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::patch('/users/{user}/status', [AdminUserController::class, 'status'])->name('users.status');
        Route::get('/classrooms', [AdminClassroomController::class, 'index'])->name('classrooms.index');
        Route::get('/classrooms/{classroom}', [ClassroomViewerController::class, 'show'])->name('classrooms.show');
        Route::post('/classrooms', [AdminClassroomController::class, 'store'])->name('classrooms.store');
        Route::post('/classrooms/{classroom}/teachers', [AdminClassroomController::class, 'assignTeacher'])->name('classrooms.teachers.store');
        Route::post('/classrooms/{classroom}/enrollments', [AdminClassroomController::class, 'enroll'])->name('classrooms.enrollments.store');
        Route::post('/classrooms/import-students', StudentImportController::class)->name('classrooms.students.import');
        Route::get('/classrooms/import-students/template', [StudentImportController::class, 'template'])->name('classrooms.students.import-template');
        Route::get('/courses', [AdminCourseController::class, 'index'])->name('courses.index');
        Route::post('/courses', [AdminCourseController::class, 'store'])->name('courses.store');
        Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
        Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
        Route::get('/lessons/{lesson}/builder', [LessonController::class, 'builder'])->name('lessons.builder');
        Route::get('/lessons/{lesson}/preview', [LessonController::class, 'preview'])->name('lessons.preview');
        Route::put('/lessons/{lesson}', [LessonController::class, 'save'])->name('lessons.save');
        Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
        Route::post('/lessons/{lesson}/publish', [LessonController::class, 'publish'])->name('lessons.publish');
        Route::post('/lessons/{lesson}/assign', [LessonController::class, 'assign'])->name('lessons.assign');
        Route::post('/lesson-sets', [\App\Http\Controllers\LessonSetController::class, 'store'])->name('lesson-sets.store');
        Route::delete('/lesson-sets/{lessonSet}', [\App\Http\Controllers\LessonSetController::class, 'destroy'])->name('lesson-sets.destroy');
        Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
        Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
        Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
        Route::post('/assignment-versions/{version}/deliver', [AssignmentController::class, 'deliver'])->name('assignments.deliver');
        Route::get('/submissions', [GradeController::class, 'index'])->name('submissions.index');
        Route::get('/gradebook', [GradeController::class, 'index'])->name('gradebook.index');
        Route::get('/submissions/{submission}', [GradeController::class, 'show'])->name('submissions.show');
        Route::put('/submissions/{submission}/grade', [GradeController::class, 'update'])->name('submissions.grade');
        Route::post('/grades/{grade}/release', [GradeController::class, 'release'])->name('grades.release');
        Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::patch('/questions/{question}/review', [QuestionController::class, 'review'])->name('questions.review');
        Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
        Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
        Route::post('/documents/{document}/retry', [DocumentController::class, 'retry'])->name('documents.retry');
        Route::get('/ai-generator', [AiGenerationController::class, 'index'])->name('ai.index');
        Route::post('/ai-generator', [AiGenerationController::class, 'store'])->middleware('throttle:5,1')->name('ai.store');
        Route::get('/ai-jobs/{job}', [AiGenerationController::class, 'status'])->name('ai.status');
        Route::post('/ai-jobs/{job}/cancel', [AiGenerationController::class, 'cancel'])->name('ai.cancel');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/audit-logs', AuditLogController::class)->name('audit.index');
    });

    Route::prefix('teacher')->name('teacher.')->middleware('primary-role:TEACHER')->group(function () {
        Route::post('/media/audio', [MediaAssetController::class, 'storeAudio'])->name('media.audio.store');
        Route::post('/media/image', [MediaAssetController::class, 'storeImage'])->name('media.image.store');
        Route::get('/dashboard', [DashboardController::class, 'teacher'])->name('dashboard');
        Route::get('/classes', [ClassroomViewerController::class, 'classes'])->name('classes.index');
        Route::get('/classes/{classroom}', [ClassroomViewerController::class, 'show'])->name('classes.show');
        Route::get('/students', [ClassroomViewerController::class, 'students'])->name('students.index');
        Route::post('/classrooms/import-students', StudentImportController::class)->name('classrooms.students.import');
        Route::get('/classrooms/import-students/template', [StudentImportController::class, 'template'])->name('classrooms.students.import-template');
        Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
        Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
        Route::get('/lessons/{lesson}/builder', [LessonController::class, 'builder'])->name('lessons.builder');
        Route::get('/lessons/{lesson}/preview', [LessonController::class, 'preview'])->name('lessons.preview');
        Route::put('/lessons/{lesson}', [LessonController::class, 'save'])->name('lessons.save');
        Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
        Route::post('/lessons/{lesson}/publish', [LessonController::class, 'publish'])->name('lessons.publish');
        Route::post('/lessons/{lesson}/assign', [LessonController::class, 'assign'])->name('lessons.assign');
        Route::post('/lesson-sets', [\App\Http\Controllers\LessonSetController::class, 'store'])->name('lesson-sets.store');
        Route::delete('/lesson-sets/{lessonSet}', [\App\Http\Controllers\LessonSetController::class, 'destroy'])->name('lesson-sets.destroy');
        Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
        Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
        Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
        Route::post('/assignment-versions/{version}/deliver', [AssignmentController::class, 'deliver'])->name('assignments.deliver');
        Route::get('/submissions', [GradeController::class, 'index'])->name('submissions.index');
        Route::get('/gradebook', [GradeController::class, 'index'])->name('gradebook.index');
        Route::get('/submissions/{submission}', [GradeController::class, 'show'])->name('submissions.show');
        Route::put('/submissions/{submission}/grade', [GradeController::class, 'update'])->name('submissions.grade');
        Route::post('/grades/{grade}/release', [GradeController::class, 'release'])->name('grades.release');
        Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
        Route::patch('/questions/{question}/review', [QuestionController::class, 'review'])->name('questions.review');
        Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
        Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
        Route::get('/ai-generator', [AiGenerationController::class, 'index'])->name('ai.index');
        Route::post('/ai-generator', [AiGenerationController::class, 'store'])->middleware('throttle:5,1')->name('ai.store');
        Route::get('/ai-jobs/{job}', [AiGenerationController::class, 'status'])->name('ai.status');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::post('/ai-jobs/{job}/cancel', [AiGenerationController::class, 'cancel'])->name('ai.cancel');
        Route::post('/documents/{document}/retry', [DocumentController::class, 'retry'])->name('documents.retry');
    });

    Route::prefix('student')->name('student.')->middleware('primary-role:STUDENT')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'student'])->name('dashboard');
        Route::get('/classes', [StudentContentController::class, 'classes'])->name('classes.index');
        Route::get('/lessons', [StudentContentController::class, 'lessons'])->name('lessons.index');
        Route::get('/lessons/{lesson}', [LessonController::class, 'player'])->name('lessons.show');
        Route::get('/assignments', [StudentContentController::class, 'assignments'])->name('assignments.index');
        Route::get('/assignments/{delivery}', [StudentContentController::class, 'assignment'])->name('assignments.show');
        Route::post('/assignments/{delivery}/start', [SubmissionController::class, 'start'])->name('submissions.start');
        Route::put('/submissions/{submission}/answer', [SubmissionController::class, 'save'])->name('submissions.save');
        Route::post('/submissions/{submission}/submit', [SubmissionController::class, 'submit'])->name('submissions.submit');
        Route::get('/grades', [StudentContentController::class, 'grades'])->name('grades.index');
    });
});

require __DIR__.'/auth.php';
