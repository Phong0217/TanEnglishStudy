<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_sets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('DRAFT')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('lesson_set_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('lesson_set_id')->constrained('lesson_sets')->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
            $table->unsignedInteger('position');
            $table->timestamps();
            $table->unique(['lesson_set_id', 'lesson_id']);
            $table->unique(['lesson_set_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_set_items');
        Schema::dropIfExists('lesson_sets');
    }
};
