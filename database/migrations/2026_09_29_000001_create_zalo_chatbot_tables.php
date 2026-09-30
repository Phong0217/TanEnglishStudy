<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zalo_group_connections', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('classroom_id')->constrained()->restrictOnDelete();
            $table->foreignId('active_lesson_id')->nullable()->constrained('lessons')->nullOnDelete();
            $table->string('group_id', 191);
            $table->string('group_name')->nullable();
            $table->string('status', 32)->default('ACTIVE')->index();
            $table->foreignId('connected_by')->constrained('users')->restrictOnDelete();
            $table->timestamp('last_event_at')->nullable();
            $table->json('settings_json')->nullable();
            $table->timestamps();
            $table->unique(['center_id', 'group_id'], 'zalo_group_center_unique');
            $table->unique(['center_id', 'classroom_id'], 'zalo_classroom_center_unique');
        });

        Schema::create('zalo_webhook_events', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('center_id')->nullable()->constrained()->nullOnDelete();
            $table->string('event_id', 191)->unique();
            $table->string('group_id', 191)->nullable()->index();
            $table->string('event_type', 80)->nullable()->index();
            $table->string('status', 32)->default('RECEIVED')->index();
            $table->json('payload_json')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });

        Schema::create('zalo_speaking_submissions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('center_id')->constrained()->restrictOnDelete();
            $table->foreignId('zalo_group_connection_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lesson_block_id')->nullable()->constrained('lesson_blocks')->nullOnDelete();
            $table->unsignedInteger('sequence_number');
            $table->string('external_message_id', 191)->nullable();
            $table->string('external_media_id', 191)->nullable();
            $table->string('sender_hash', 128)->nullable();
            $table->string('status', 32)->default('RECEIVED')->index();
            $table->string('storage_disk', 80)->nullable();
            $table->string('storage_path')->nullable();
            $table->string('mime_type', 120)->nullable();
            $table->unsignedBigInteger('size_bytes')->nullable();
            $table->unsignedInteger('duration_seconds')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->text('transcript')->nullable();
            $table->json('evaluation_json')->nullable();
            $table->json('metadata_json')->nullable();
            $table->timestamp('received_at')->index();
            $table->timestamp('processed_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
            $table->unique(['center_id', 'external_message_id'], 'zalo_external_message_unique');
            $table->unique(['zalo_group_connection_id', 'sequence_number'], 'zalo_group_sequence_unique');
            $table->index(['zalo_group_connection_id', 'received_at'], 'zalo_submission_connection_received_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zalo_speaking_submissions');
        Schema::dropIfExists('zalo_webhook_events');
        Schema::dropIfExists('zalo_group_connections');
    }
};
