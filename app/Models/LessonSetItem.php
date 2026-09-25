<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonSetItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lessonSet(): BelongsTo
    {
        return $this->belongsTo(LessonSet::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
