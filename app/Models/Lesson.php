<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['status' => ContentStatus::class, 'learning_objectives_json' => 'array', 'published_at' => 'datetime'];
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(LessonBlock::class)->orderBy('position');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(LessonVersion::class)->orderByDesc('version_number');
    }

    public function publishedVersion(): BelongsTo
    {
        return $this->belongsTo(LessonVersion::class, 'published_version_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'source_lesson_id');
    }
}
