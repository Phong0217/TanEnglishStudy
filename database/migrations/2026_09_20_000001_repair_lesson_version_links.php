<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('lessons')->orderBy('id')->get()->each(function (object $lesson): void {
            $published = $lesson->published_version_id
                ? DB::table('lesson_versions')->where('id', $lesson->published_version_id)->where('lesson_id', $lesson->id)->first()
                : null;
            $preferred = DB::table('lesson_versions')
                ->where('lesson_id', $lesson->id)
                ->orderByRaw("CASE WHEN status = 'PUBLISHED' THEN 0 ELSE 1 END")
                ->orderByDesc('version_number')
                ->first();

            $version = ($lesson->status === 'PUBLISHED' ? $published : null) ?: $preferred ?: $this->createVersion($lesson);
            if ($lesson->status === 'PUBLISHED') {
                // A legacy row may have a DRAFT version but no published
                // pointer. Promote the repaired version consistently so the
                // Student player never receives draft content.
                if ($version->status !== 'PUBLISHED') {
                    DB::table('lesson_versions')->where('id', $version->id)->update([
                        'status' => 'PUBLISHED',
                        'published_at' => $lesson->published_at ?: now(),
                    ]);
                }
                if (! $published || (int) $lesson->published_version_id !== (int) $version->id) {
                    DB::table('lessons')->where('id', $lesson->id)->update(['published_version_id' => $version->id]);
                }
            }

            DB::table('lesson_blocks')
                ->where('lesson_id', $lesson->id)
                ->whereNull('lesson_version_id')
                ->update(['lesson_version_id' => $version->id]);
        });
    }

    public function down(): void
    {
        // This migration repairs missing relationships and is intentionally
        // non-destructive; there is no safe rollback for restored links.
    }

    private function createVersion(object $lesson): object
    {
        $id = DB::table('lesson_versions')->insertGetId([
            'lesson_id' => $lesson->id,
            'version_number' => 1,
            'title_snapshot' => $lesson->title,
            'description_snapshot' => $lesson->description,
            'instructions_snapshot' => $lesson->instructions,
            'learning_objectives_json' => $lesson->learning_objectives_json,
            'status' => $lesson->status,
            'lock_version' => 1,
            'created_by' => $lesson->created_by,
            'published_at' => $lesson->published_at,
            'created_at' => $lesson->created_at,
            'updated_at' => $lesson->updated_at,
        ]);

        return DB::table('lesson_versions')->where('id', $id)->first();
    }
};
