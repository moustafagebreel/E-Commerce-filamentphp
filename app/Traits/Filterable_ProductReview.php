<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable_ProductReview
{
    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeActiveOnly(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
