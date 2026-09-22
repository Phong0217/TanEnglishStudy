<?php

namespace App\Models;

use App\Models\Concerns\BelongsToCenter;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use BelongsToCenter;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['old_values_json' => 'array', 'new_values_json' => 'array', 'created_at' => 'datetime'];
    }
}
