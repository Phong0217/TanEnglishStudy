<?php

namespace App\Http\Controllers;

use App\Models\ZaloGroupConnection;
use App\Enums\BlockType;
use App\Models\ZaloSpeakingSubmission;
use App\Models\ZaloWebhookEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ZaloWebhookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if (! $this->validSignature($request)) {
            return response()->json(['accepted' => false, 'message' => 'Invalid webhook signature.'], 401);
        }

        $payload = $request->all();
        $eventId = (string) (data_get($payload, 'event_id') ?: data_get($payload, 'message_id') ?: Str::uuid());
        $groupId = data_get($payload, 'group_id') ?: data_get($payload, 'message.group_id');
        $eventType = data_get($payload, 'event_name') ?: data_get($payload, 'event_type') ?: 'message';
        $connection = $groupId ? ZaloGroupConnection::withoutGlobalScopes()->with('activeLesson.blocks')->where('group_id', (string) $groupId)->where('status', 'ACTIVE')->first() : null;

        $event = ZaloWebhookEvent::firstOrCreate(
            ['event_id' => $eventId],
            ['center_id' => $connection?->center_id, 'group_id' => $groupId, 'event_type' => $eventType, 'status' => 'RECEIVED', 'payload_json' => $this->safePayload($payload)],
        );
        if (! $event->wasRecentlyCreated) {
            return response()->json(['accepted' => true, 'duplicate' => true]);
        }
        if (! $connection) {
            $event->update(['status' => 'IGNORED', 'processed_at' => now(), 'error_message' => 'Group is not connected to an active classroom.']);

            return response()->json(['accepted' => true, 'ignored' => true]);
        }

        $attachment = $this->videoAttachment($payload);
        if (! $attachment) {
            $event->update(['status' => 'IGNORED', 'processed_at' => now(), 'error_message' => 'No video attachment found.']);

            return response()->json(['accepted' => true, 'ignored' => true]);
        }
        $sender = (string) (data_get($payload, 'sender_id') ?: data_get($payload, 'sender.user_id') ?: data_get($payload, 'message.sender_id') ?: '');
        $lessonBlockId = $connection->activeLesson?->blocks?->first(fn ($block) => $block->block_type === BlockType::SPEAKING_PROMPT)?->id;
        $submission = DB::transaction(function () use ($connection, $eventId, $attachment, $sender, $lessonBlockId): ZaloSpeakingSubmission {
            $sequence = ((int) $connection->submissions()->lockForUpdate()->max('sequence_number')) + 1;

            return ZaloSpeakingSubmission::create([
                'center_id' => $connection->center_id,
                'zalo_group_connection_id' => $connection->id,
                'lesson_id' => $connection->active_lesson_id,
                'lesson_block_id' => $lessonBlockId,
                'sequence_number' => $sequence,
                'external_message_id' => $eventId,
                'external_media_id' => $attachment['media_id'],
                'sender_hash' => $sender !== '' ? hash_hmac('sha256', $sender, (string) config('app.key')) : null,
                'status' => 'RECEIVED',
                'mime_type' => $attachment['mime_type'],
                'metadata_json' => ['source' => 'zalo_group_webhook'],
                'received_at' => now(),
            ]);
        });
        $connection->update(['last_event_at' => now()]);
        $event->update(['status' => 'ACCEPTED', 'processed_at' => now()]);

        return response()->json(['accepted' => true, 'submission_id' => $submission->id, 'status' => $submission->status]);
    }

    private function validSignature(Request $request): bool
    {
        $secret = (string) config('services.zalo.webhook_secret');
        if ($secret === '') {
            return app()->environment(['local', 'testing']);
        }
        $signature = (string) ($request->header('X-Zalo-Signature') ?: $request->header('X-Webhook-Signature'));
        if ($signature === '') {
            return false;
        }
        $signature = preg_replace('/^sha256=/i', '', $signature) ?: $signature;
        $expected = hash_hmac('sha256', $request->getContent(), $secret);

        return hash_equals($expected, $signature);
    }

    private function videoAttachment(array $payload): ?array
    {
        $attachments = data_get($payload, 'message.attachments', data_get($payload, 'attachments', []));
        foreach ((array) $attachments as $attachment) {
            $type = strtolower((string) (data_get($attachment, 'type') ?: data_get($attachment, 'media_type')));
            $mediaId = data_get($attachment, 'media_id') ?: data_get($attachment, 'id');
            if ($mediaId && ($type === 'video' || str_starts_with($type, 'video/'))) {
                return ['media_id' => (string) $mediaId, 'mime_type' => $type !== '' ? $type : 'video/*'];
            }
        }

        return null;
    }

    private function safePayload(array $payload): array
    {
        $safe = $payload;
        unset($safe['access_token'], $safe['token'], $safe['video'], $safe['file'], $safe['content']);

        return $safe;
    }
}
