<?php

namespace App\Models;

use App\Enums\AssignmentStatus;
use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use BelongsToCenter, HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['status' => AssignmentStatus::class];
    }

    public function sourceLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'source_lesson_id');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(AssignmentVersion::class)->orderByDesc('version_number');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
