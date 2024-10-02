<?php

namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Scope a query to be filtered using model rules.
     */
    public function scopeFilter(Builder $query): void
    {
        //
    }
}