<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['content_snapshot_json' => 'array', 'answer_key_snapshot_json' => 'array', 'settings_snapshot_json' => 'array', 'rubric_snapshot' => 'array', 'points' => 'decimal:2'];
    }

    public function assignmentVersion(): BelongsTo
    {
        return $this->belongsTo(AssignmentVersion::class);
    }

    public function questionVersion(): BelongsTo
    {
        return $this->belongsTo(QuestionVersion::class);
    }

    public function sourceLessonBlock(): BelongsTo
    {
        return $this->belongsTo(LessonBlock::class);
    }
}
