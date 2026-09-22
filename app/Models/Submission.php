<?php

namespace App\Models;

use App\Enums\SubmissionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Submission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['status' => SubmissionStatus::class, 'started_at' => 'datetime', 'last_saved_at' => 'datetime', 'submitted_at' => 'datetime'];
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(AssignmentDelivery::class, 'assignment_delivery_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(SubmissionAnswer::class);
    }

    public function grade(): HasOne
    {
        return $this->hasOne(Grade::class);
    }
}
