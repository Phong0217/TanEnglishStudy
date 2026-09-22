<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionVersion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['content_json' => 'array', 'answer_key_json' => 'array', 'settings_json' => 'array', 'rubric' => 'array'];
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function sources(): HasMany
    {
        return $this->hasMany(QuestionSource::class);
    }

    public function assignmentItems(): HasMany
    {
        return $this->hasMany(AssignmentItem::class);
    }

    public function lessonBlocks(): HasMany
    {
        return $this->hasMany(LessonBlock::class);
    }
}
