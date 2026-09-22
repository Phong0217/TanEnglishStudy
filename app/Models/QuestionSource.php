<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionSource extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function questionVersion(): BelongsTo
    {
        return $this->belongsTo(QuestionVersion::class);
    }

    public function documentChunk(): BelongsTo
    {
        return $this->belongsTo(DocumentChunk::class);
    }
}
