<?php

namespace App\Models;

use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonSet extends Model
{
    use BelongsToCenter, HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function items(): HasMany
    {
        return $this->hasMany(LessonSetItem::class)->orderBy('position');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
