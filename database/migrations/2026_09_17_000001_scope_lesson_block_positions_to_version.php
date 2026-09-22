<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lesson_blocks', function (Blueprint $table): void {
            // lesson_id is a foreign-key column and still needs a non-unique
            // supporting index after the old (lesson_id, position) unique key
            // is removed.
            $table->index('lesson_id', 'lesson_blocks_lesson_id_index_for_fk');
            $table->dropUnique('lesson_blocks_lesson_id_position_unique');
        });
    }

    public function down(): void
    {
        Schema::table('lesson_blocks', function (Blueprint $table): void {
            $table->unique(['lesson_id', 'position'], 'lesson_blocks_lesson_id_position_unique');
            $table->dropIndex('lesson_blocks_lesson_id_index_for_fk');
        });
    }
};
