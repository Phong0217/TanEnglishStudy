<?php

namespace App\Models;

use App\Enums\ContentStatus;
use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use BelongsToCenter, HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['status' => ContentStatus::class, 'published_at' => 'datetime'];
    }

    public function versions(): HasMany
    {
        return $this->hasMany(CourseVersion::class);
    }
}
