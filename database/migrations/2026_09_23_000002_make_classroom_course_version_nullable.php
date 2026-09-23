<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classrooms', function (Blueprint $table): void {
            $table->foreignId('course_version_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Existing independent classrooms cannot be safely assigned an
        // arbitrary course version during rollback, so keep this change
        // reversible only through an explicit data migration.
    }
};
