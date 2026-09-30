<?php

namespace App\Models;

use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ZaloSpeakingSubmission extends Model
{
    use BelongsToCenter;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'evaluation_json' => 'array',
            'metadata_json' => 'array',
            'received_at' => 'datetime',
            'processed_at' => 'datetime',
            'score' => 'decimal:2',
        ];
    }

    public function connection(): BelongsTo
    {
        return $this->belongsTo(ZaloGroupConnection::class, 'zalo_group_connection_id');
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function lessonBlock(): BelongsTo
    {
        return $this->belongsTo(LessonBlock::class);
    }
}
