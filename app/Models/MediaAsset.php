<?php

namespace App\Models;

use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaAsset extends Model
{
    use BelongsToCenter, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['metadata_json' => 'array'];
    }
}
