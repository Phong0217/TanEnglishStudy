<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZaloWebhookEvent extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['payload_json' => 'array', 'processed_at' => 'datetime'];
    }
}
