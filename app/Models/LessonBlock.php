<?php

namespace App\Models;

use App\Enums\BlockType;
use App\Enums\GradingMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonBlock extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['block_type' => BlockType::class, 'grading_mode' => GradingMode::class, 'content_json' => 'array', 'answer_key_json' => 'array', 'settings_json' => 'array', 'required' => 'boolean', 'points' => 'decimal:2'];
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function lessonVersion(): BelongsTo
    {
        return $this->belongsTo(LessonVersion::class);
    }

    public function questionVersion(): BelongsTo
    {
        return $this->belongsTo(QuestionVersion::class);
    }
}
