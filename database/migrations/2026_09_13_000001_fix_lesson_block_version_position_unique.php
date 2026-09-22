<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lesson_blocks', function (Blueprint $table): void {
            $table->unique(['lesson_version_id', 'position'], 'lesson_blocks_version_position_unique');
        });
    }

    public function down(): void
    {
        Schema::table('lesson_blocks', function (Blueprint $table): void {
            $table->dropUnique('lesson_blocks_version_position_unique');
            $table->dropForeign(['lesson_id']);
            $table->unique(['lesson_id', 'position'], 'lesson_blocks_lesson_id_position_unique');
            $table->foreign('lesson_id')->references('id')->on('lessons')->cascadeOnDelete();
        });
    }
};
