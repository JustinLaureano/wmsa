<?php

namespace App\Support\Eloquent\Filter\Rules;

use App\Support\Eloquent\Filter\Contracts\QueryFilter;

class In implements QueryFilter
{
    public function __invoke($query, $field, $value)
    {
        $query->whereIn($field, $value);
    }
}