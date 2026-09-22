<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('assignment_deliveries', 'show_correct_answers')) {
            Schema::table('assignment_deliveries', function (Blueprint $table): void {
                $table->boolean('show_correct_answers')->default(false)->after('allow_review');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('assignment_deliveries', 'show_correct_answers')) {
            Schema::table('assignment_deliveries', function (Blueprint $table): void {
                $table->dropColumn('show_correct_answers');
            });
        }
    }
};
