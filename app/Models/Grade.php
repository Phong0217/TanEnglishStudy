<?php

namespace App\Models;

use App\Enums\GradeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['status' => GradeStatus::class, 'graded_at' => 'datetime', 'released_at' => 'datetime', 'final_score' => 'decimal:2'];
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function audits(): HasMany
    {
        return $this->hasMany(GradeAudit::class);
    }
}
