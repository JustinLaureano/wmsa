<?php

namespace App\Support\Eloquent\Filter;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Scope a query to be filtered using model rules.
     */
    public function scopeFilter(Builder $query): void
    {
        $filter = app(Filter::class);

        if (method_exists($this, 'getFilterable'))
        {
            $filter->setFilterable($this->getFilterable());
        }
        elseif (property_exists($this, 'filterable'))
        {
            $filter->setFilterable($this->filterable);
        }
        else {
            $filter->setFilterable([]);
        }

        $filter->apply($query, app('request'))->clearFilterable();
    }
}