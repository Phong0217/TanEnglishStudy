<?php

namespace App\Models;

use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AiGenerationJob extends Model
{
    use BelongsToCenter;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['request_json' => 'array', 'progress_json' => 'array', 'started_at' => 'datetime', 'completed_at' => 'datetime'];
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(SourceDocument::class, 'ai_job_documents');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
