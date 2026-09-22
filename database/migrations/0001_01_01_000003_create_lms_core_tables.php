<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('teacher_code')->unique();
            $table->string('phone')->nullable();
            $table->string('specialization')->nullable();
            $table->text('biography')->nullable();
            $table->date('joined_at')->nullable();
            $table->json('metadata_json')->nullable();
            $table->timestamps();
        });

        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('student_code')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_email')->nullable();
            $table->date('joined_at')->nullable();
            $table->json('metadata_json')->nullable();
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->string('code');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('grade_level')->nullable();
            $table->string('cefr_level')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('status')->default('DRAFT')->index();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['center_id', 'code']);
        });

        Schema::create('course_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->restrictOnDelete();
            $table->string('code');
            $table->string('title');
            $table->string('version_number')->nullable();
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('DRAFT')->index();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->unique(['course_id', 'code']);
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_version_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('learning_objectives_json')->nullable();
            $table->unsignedInteger('position');
            $table->string('status')->default('DRAFT');
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['course_version_id', 'position']);
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->json('learning_objectives_json')->nullable();
            $table->unsignedSmallInteger('estimated_duration_minutes')->nullable();
            $table->unsignedInteger('position');
            $table->string('status')->default('DRAFT')->index();
            $table->unsignedInteger('lock_version')->default(1);
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['unit_id', 'position']);
        });

        Schema::create('media_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('uploaded_by')->constrained('users')->restrictOnDelete();
            $table->string('asset_type');
            $table->string('original_name');
            $table->string('disk');
            $table->string('path');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size');
            $table->string('checksum', 64)->nullable()->index();
            $table->json('metadata_json')->nullable();
            $table->string('status')->default('READY');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('source_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('course_version_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('uploaded_by')->constrained('users')->restrictOnDelete();
            $table->string('original_name');
            $table->string('disk');
            $table->string('storage_path');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size');
            $table->string('checksum', 64)->nullable();
            $table->string('status')->default('UPLOADED')->index();
            $table->unsignedInteger('page_count')->nullable();
            $table->string('parser_name')->nullable();
            $table->json('parser_metadata_json')->nullable();
            $table->decimal('parse_confidence', 5, 2)->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['center_id', 'checksum']);
        });

        Schema::create('document_chunks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_document_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('chunk_index');
            $table->unsignedInteger('page_number')->nullable();
            $table->string('heading')->nullable();
            $table->longText('content');
            $table->unsignedInteger('token_count')->nullable();
            $table->decimal('parse_confidence', 5, 2)->nullable();
            $table->json('metadata_json')->nullable();
            $table->timestamps();
            $table->unique(['source_document_id', 'chunk_index']);
        });

        Schema::create('ai_generation_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('requested_by')->constrained('users')->restrictOnDelete();
            $table->string('status')->default('QUEUED')->index();
            $table->json('request_json');
            $table->string('provider')->nullable();
            $table->string('model')->nullable();
            $table->string('prompt_version')->nullable();
            $table->unsignedInteger('generated_count')->default(0);
            $table->unsignedInteger('accepted_count')->default(0);
            $table->unsignedInteger('input_tokens')->nullable();
            $table->unsignedInteger('output_tokens')->nullable();
            $table->decimal('estimated_cost', 12, 6)->nullable();
            $table->text('error_message')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('ai_job_documents', function (Blueprint $table) {
            $table->foreignId('ai_generation_job_id')->constrained()->cascadeOnDelete();
            $table->foreignId('source_document_id')->constrained()->cascadeOnDelete();
            $table->unique(['ai_generation_job_id', 'source_document_id'], 'ai_job_document_unique');
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->string('type')->index();
            $table->string('skill')->nullable()->index();
            $table->string('difficulty')->nullable()->index();
            $table->string('status')->default('DRAFT')->index();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('ai_generation_job_id')->nullable()->constrained()->nullOnDelete();
            $table->string('content_hash', 64)->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('question_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('version_number');
            $table->json('content_json');
            $table->json('answer_key_json')->nullable();
            $table->json('settings_json')->nullable();
            $table->text('explanation')->nullable();
            $table->json('rubric')->nullable();
            $table->unsignedSmallInteger('schema_version')->default(1);
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
            $table->unique(['question_id', 'version_number']);
        });

        Schema::create('question_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_version_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_chunk_id')->constrained()->restrictOnDelete();
            $table->unsignedInteger('page_number')->nullable();
            $table->text('source_excerpt');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('lesson_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_version_id')->nullable()->constrained()->nullOnDelete();
            $table->string('block_type')->index();
            $table->json('content_json');
            $table->json('answer_key_json')->nullable();
            $table->json('settings_json')->nullable();
            $table->unsignedSmallInteger('schema_version')->default(1);
            $table->decimal('points', 8, 2)->default(0);
            $table->unsignedInteger('position');
            $table->boolean('required')->default(false);
            $table->string('grading_mode')->default('AUTO');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['lesson_id', 'position']);
        });

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('course_version_id')->constrained()->restrictOnDelete();
            $table->foreignId('primary_teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('code');
            $table->text('description')->nullable();
            $table->string('status')->default('DRAFT')->index();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['center_id', 'code']);
        });

        Schema::create('classroom_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('users')->restrictOnDelete();
            $table->string('assignment_role')->default('TEACHER');
            $table->string('status')->default('ACTIVE')->index();
            $table->foreignId('assigned_by')->constrained('users')->restrictOnDelete();
            $table->timestamp('assigned_at');
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            $table->unique(['classroom_id', 'teacher_id']);
        });

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->restrictOnDelete();
            $table->foreignId('student_id')->constrained('users')->restrictOnDelete();
            $table->string('status')->default('ACTIVE')->index();
            $table->timestamp('enrolled_at');
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('withdrawn_at')->nullable();
            $table->timestamp('transferred_at')->nullable();
            $table->foreignId('transferred_from_enrollment_id')->nullable()->constrained('enrollments')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->unique(['classroom_id', 'student_id']);
        });

        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('source_lesson_id')->nullable()->constrained('lessons')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('DRAFT')->index();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('assignment_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('version_number');
            $table->text('instructions')->nullable();
            $table->decimal('total_points', 8, 2);
            $table->json('grading_settings_json')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
            $table->unique(['assignment_id', 'version_number']);
        });

        Schema::create('assignment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_version_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_version_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('source_lesson_block_id')->nullable()->constrained('lesson_blocks')->nullOnDelete();
            $table->string('item_type');
            $table->json('content_snapshot_json');
            $table->json('answer_key_snapshot_json')->nullable();
            $table->json('settings_snapshot_json')->nullable();
            $table->text('explanation_snapshot')->nullable();
            $table->json('rubric_snapshot')->nullable();
            $table->decimal('points', 8, 2);
            $table->unsignedInteger('position');
            $table->timestamps();
            $table->unique(['assignment_version_id', 'position']);
        });

        Schema::create('assignment_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_version_id')->constrained()->restrictOnDelete();
            $table->foreignId('classroom_id')->constrained()->restrictOnDelete();
            $table->string('status')->default('DRAFT')->index();
            $table->timestamp('open_at')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->timestamp('close_at')->nullable();
            $table->unsignedSmallInteger('max_attempts')->default(1);
            $table->unsignedSmallInteger('time_limit_minutes')->nullable();
            $table->boolean('allow_late_submission')->default(false);
            $table->string('result_release_policy')->default('AFTER_GRADING');
            $table->foreignId('assigned_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
            $table->unique(['assignment_version_id', 'classroom_id'], 'assignment_delivery_unique');
        });

        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_delivery_id')->constrained()->restrictOnDelete();
            $table->foreignId('student_id')->constrained('users')->restrictOnDelete();
            $table->unsignedSmallInteger('attempt_number');
            $table->string('status')->default('IN_PROGRESS')->index();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('last_saved_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->unique(['assignment_delivery_id', 'student_id', 'attempt_number'], 'submission_attempt_unique');
        });

        Schema::create('submission_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assignment_item_id')->constrained()->restrictOnDelete();
            $table->json('response_json')->nullable();
            $table->decimal('auto_score', 8, 2)->nullable();
            $table->decimal('manual_score', 8, 2)->nullable();
            $table->decimal('ai_suggested_score', 8, 2)->nullable();
            $table->decimal('final_score', 8, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->string('grading_status')->default('PENDING')->index();
            $table->foreignId('graded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('graded_at')->nullable();
            $table->timestamps();
            $table->unique(['submission_id', 'assignment_item_id']);
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->unique()->constrained()->restrictOnDelete();
            $table->decimal('auto_score', 8, 2)->nullable();
            $table->decimal('manual_score', 8, 2)->nullable();
            $table->decimal('final_score', 8, 2)->default(0);
            $table->string('status')->default('DRAFT')->index();
            $table->text('general_feedback')->nullable();
            $table->foreignId('graded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('graded_at')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->timestamps();
        });

        Schema::create('grade_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')->constrained()->restrictOnDelete();
            $table->foreignId('submission_id')->constrained()->restrictOnDelete();
            $table->decimal('old_score', 8, 2)->nullable();
            $table->decimal('new_score', 8, 2)->nullable();
            $table->string('old_status')->nullable();
            $table->string('new_status')->nullable();
            $table->text('reason');
            $table->foreignId('changed_by')->constrained('users')->restrictOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->restrictOnDelete();
            $table->foreignId('lesson_id')->constrained()->restrictOnDelete();
            $table->foreignId('student_id')->constrained('users')->restrictOnDelete();
            $table->string('status')->default('NOT_STARTED');
            $table->decimal('progress_percent', 5, 2)->default(0);
            $table->foreignId('last_block_id')->nullable()->constrained('lesson_blocks')->nullOnDelete();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->unique(['classroom_id', 'lesson_id', 'student_id'], 'lesson_progress_unique');
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action')->index();
            $table->string('entity_type')->index();
            $table->unsignedBigInteger('entity_id')->nullable()->index();
            $table->json('old_values_json')->nullable();
            $table->json('new_values_json')->nullable();
            $table->text('reason')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent()->index();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $tables = ['notifications', 'audit_logs', 'lesson_progress', 'grade_audits', 'grades', 'submission_answers', 'submissions', 'assignment_deliveries', 'assignment_items', 'assignment_versions', 'assignments', 'enrollments', 'classroom_teachers', 'classrooms', 'lesson_blocks', 'question_sources', 'question_versions', 'questions', 'ai_job_documents', 'ai_generation_jobs', 'document_chunks', 'source_documents', 'media_assets', 'lessons', 'units', 'course_versions', 'courses', 'student_profiles', 'teacher_profiles'];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
