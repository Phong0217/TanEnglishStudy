<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_generation_jobs', function (Blueprint $table) {
            $table->json('progress_json')->nullable();
            $table->uuid('request_key')->nullable();
            $table->unique(['center_id', 'requested_by', 'request_key'], 'ai_request_key_unique');
        });
        Schema::table('questions', function (Blueprint $table) {
            $table->foreignId('course_version_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('english_category')->nullable()->index();
            $table->string('concept')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('course_version_id');
            $table->dropColumn(['english_category', 'concept']);
        });
        Schema::table('ai_generation_jobs', function (Blueprint $table) {
            $table->dropUnique('ai_request_key_unique');
            $table->dropColumn(['progress_json', 'request_key']);
        });
    }
};
