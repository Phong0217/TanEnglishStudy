<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('assignment_deliveries', 'allow_review')) {
            Schema::table('assignment_deliveries', function (Blueprint $table): void {
                $table->boolean('allow_review')->default(false)->after('allow_late_submission');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('assignment_deliveries', 'allow_review')) {
            Schema::table('assignment_deliveries', function (Blueprint $table): void {
                $table->dropColumn('allow_review');
            });
        }
    }
};
