<?php

namespace App\Models\Concerns;

use App\Models\Center;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToCenter
{
    protected static function bootBelongsToCenter(): void
    {
        static::addGlobalScope('center', function (Builder $builder): void {
            if (auth()->check()) {
                $builder->where($builder->qualifyColumn('center_id'), auth()->user()->center_id);
            }
        });
    }

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }
}
