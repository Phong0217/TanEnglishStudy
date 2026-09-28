<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ai_generation_jobs', function (Blueprint $table): void {
            $table->string('cache_key', 64)->nullable()->after('request_key');
            $table->index(['center_id', 'requested_by', 'cache_key'], 'ai_generation_cache_lookup');
        });
    }

    public function down(): void
    {
        Schema::table('ai_generation_jobs', function (Blueprint $table): void {
            $table->dropIndex('ai_generation_cache_lookup');
            $table->dropColumn('cache_key');
        });
    }
};
