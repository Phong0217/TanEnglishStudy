<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradeAudit extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }
}
