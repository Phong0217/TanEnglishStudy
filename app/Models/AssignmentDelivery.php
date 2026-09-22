<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssignmentDelivery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['open_at' => 'datetime', 'due_at' => 'datetime', 'close_at' => 'datetime', 'allow_late_submission' => 'boolean', 'allow_review' => 'boolean', 'show_correct_answers' => 'boolean'];
    }

    public function assignmentVersion(): BelongsTo
    {
        return $this->belongsTo(AssignmentVersion::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
