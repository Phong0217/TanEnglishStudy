<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['settings_json' => 'array'];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function sourceDocuments(): HasMany
    {
        return $this->hasMany(SourceDocument::class);
    }

    public function aiGenerationJobs(): HasMany
    {
        return $this->hasMany(AiGenerationJob::class);
    }
}
