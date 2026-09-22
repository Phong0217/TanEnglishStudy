<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['response_json' => 'array', 'graded_at' => 'datetime', 'auto_score' => 'decimal:2', 'manual_score' => 'decimal:2', 'ai_suggested_score' => 'decimal:2', 'final_score' => 'decimal:2'];
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(AssignmentItem::class, 'assignment_item_id');
    }
}
