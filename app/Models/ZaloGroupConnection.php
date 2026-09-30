<?php

namespace App\Models;

use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ZaloGroupConnection extends Model
{
    use BelongsToCenter;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['settings_json' => 'array', 'last_event_at' => 'datetime'];
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function activeLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'active_lesson_id');
    }

    public function connectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'connected_by');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(ZaloSpeakingSubmission::class);
    }
}
