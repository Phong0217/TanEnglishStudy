<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssignmentVersion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['grading_settings_json' => 'array', 'is_locked' => 'boolean', 'published_at' => 'datetime', 'total_points' => 'decimal:2'];
    }

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(AssignmentItem::class)->orderBy('position');
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(AssignmentDelivery::class);
    }
}
