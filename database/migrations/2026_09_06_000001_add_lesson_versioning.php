<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('version_number');
            $table->string('title_snapshot');
            $table->text('description_snapshot')->nullable();
            $table->text('instructions_snapshot')->nullable();
            $table->json('learning_objectives_json')->nullable();
            $table->string('status')->default('DRAFT')->index();
            $table->unsignedInteger('lock_version')->default(1);
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->unique(['lesson_id', 'version_number']);
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->foreignId('published_version_id')->nullable()->after('lock_version')->constrained('lesson_versions')->nullOnDelete();
        });

        Schema::table('lesson_blocks', function (Blueprint $table) {
            $table->foreignId('lesson_version_id')->nullable()->after('lesson_id')->constrained('lesson_versions')->cascadeOnDelete();
            $table->index(['lesson_version_id', 'position']);
        });

        Schema::table('assignment_versions', function (Blueprint $table) {
            $table->foreignId('source_lesson_version_id')->nullable()->after('assignment_id')->constrained('lesson_versions')->nullOnDelete();
        });

        DB::table('lessons')->orderBy('id')->eachById(function ($lesson) {
            $versionId = DB::table('lesson_versions')->insertGetId([
                'lesson_id' => $lesson->id,
                'version_number' => 1,
                'title_snapshot' => $lesson->title,
                'description_snapshot' => $lesson->description,
                'instructions_snapshot' => $lesson->instructions,
                'learning_objectives_json' => $lesson->learning_objectives_json,
                'status' => $lesson->status,
                'lock_version' => 1,
                'created_by' => $lesson->created_by,
                'published_at' => $lesson->published_at,
                'created_at' => $lesson->created_at,
                'updated_at' => $lesson->updated_at,
            ]);
            DB::table('lesson_blocks')->where('lesson_id', $lesson->id)->update(['lesson_version_id' => $versionId]);
            if ($lesson->status === 'PUBLISHED') {
                DB::table('lesson_versions')->where('id', $versionId)->update(['status' => 'PUBLISHED']);
                DB::table('lessons')->where('id', $lesson->id)->update(['published_version_id' => $versionId]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('assignment_versions', fn (Blueprint $table) => $table->dropForeign(['source_lesson_version_id']));
        Schema::table('assignment_versions', fn (Blueprint $table) => $table->dropColumn('source_lesson_version_id'));
        Schema::table('lesson_blocks', fn (Blueprint $table) => $table->dropForeign(['lesson_version_id']));
        Schema::table('lesson_blocks', fn (Blueprint $table) => $table->dropColumn('lesson_version_id'));
        Schema::table('lessons', fn (Blueprint $table) => $table->dropForeign(['published_version_id']));
        Schema::table('lessons', fn (Blueprint $table) => $table->dropColumn('published_version_id'));
        Schema::dropIfExists('lesson_versions');
    }
};
