<?php

namespace App\Models;

use App\Domain\Documents\EnglishDocumentChunks;
use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SourceDocument extends Model
{
    use BelongsToCenter, HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['parser_metadata_json' => 'array'];
    }

    public function courseVersion(): BelongsTo
    {
        return $this->belongsTo(CourseVersion::class);
    }

    public function chunks(): HasMany
    {
        return $this->hasMany(DocumentChunk::class)->orderBy('chunk_index');
    }

    /**
     * Older containers wrote section-headings-v1 chunks without activity
     * metadata. Those chunks must be rebuilt before exact extraction.
     */
    public function requiresChunkReparse(): bool
    {
        return ($this->parser_metadata_json['analysis_method'] ?? null) !== EnglishDocumentChunks::ANALYSIS_METHOD;
    }

    public function aiJobs(): BelongsToMany
    {
        return $this->belongsToMany(AiGenerationJob::class, 'ai_job_documents');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
