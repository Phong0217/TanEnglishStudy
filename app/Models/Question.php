<?php

namespace App\Models;

use App\Enums\QuestionType;
use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use BelongsToCenter, HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['type' => QuestionType::class];
    }

    public function versions(): HasMany
    {
        return $this->hasMany(QuestionVersion::class)->orderByDesc('version_number');
    }

    public function aiGenerationJob(): BelongsTo
    {
        return $this->belongsTo(AiGenerationJob::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function courseVersion(): BelongsTo
    {
        return $this->belongsTo(CourseVersion::class);
    }
}
