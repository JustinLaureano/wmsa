<?php

namespace App\Support\Eloquent\Filter\Rules;

use App\Support\Eloquent\Filter\Contracts\QueryFilter;

class SortBy implements QueryFilter
{
    /**
     * Filter values come in the $value argument as:
     *   +field_name
     *   -field_name
     * 
     *   + === 'asc
     *   - === 'desc'
     */
    public function __invoke($query, $field, $value)
    {
        $columns = explode(',', $value);

        foreach ($columns as $column) {         
            $operator = substr($column, 0, 1);
            $col = substr($column, 1);
            $direction = $operator == '+' ? 'asc' : 'desc';

            $query->orderBy($col, $direction);
        }
    }
}