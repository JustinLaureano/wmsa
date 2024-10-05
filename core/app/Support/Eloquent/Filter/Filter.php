<?php

namespace App\Support\Eloquent\Filter;

use App\Support\Eloquent\Filter\Contracts\QueryFilter;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{
    const OPERATOR_SEPARATOR = ':';

    protected array $rules = [
        'eq' => Rules\Equal::class,
        'like' => Rules\Like::class,
        'gt' => Rules\GreaterThan::class,
        'lt' => Rules\LessThan::class,
        'in' => Rules\In::class,
    ];

    /** TODO: set to search */
    protected string $defaultRule = 'like';

    protected array $baseFilters = [
        'sortBy',
        'perPage',
    ];

    protected array $filterable = [];

    /**
     * Apply the filter based on request
     */
    public function apply(Builder $query, Request $request): self
    {
        $callback = $this->getCallback($request);

        $query->where($callback);

        return $this;
    }

    /**
     * Get the callback with queries created from request to filter the models
     */
    protected function getCallback(Request $request): Closure
    {
        $filters = $this->filterable;

        return function ($query) use ($filters, $request) {

            foreach ($request->only($filters) as $field => $filter) {
                $rule = $this->getFilterRule($filter);
                $value = $this->getFilterValue($filter);

                $rule($query, $field, $value);
            }

            return $query;
        };
    }

    /**
     * Parse the filter rule from the string if there is one.
     */
    protected function getFilterRule(string $filter) : QueryFilter
    {
        if ( !str_contains($filter, static::OPERATOR_SEPARATOR) ) {
            return $this->rules[$this->defaultRule];
        }

        [$operator] = explode(static::OPERATOR_SEPARATOR, $filter);

        $rule = $this->rules[$operator] ?? $this->rules[$this->defaultRule];

        return new $rule;
    }

    /**
     * Parse the filter value from the filter string.
     */
    protected function getFilterValue(string $filter) : string
    {
        if ( !str_contains($filter, static::OPERATOR_SEPARATOR) ) {
            return $filter;
        }

        [$operator, $value] = explode(static::OPERATOR_SEPARATOR, $filter);

        return $value;
    }

    /**
     * Set the filterable fields allowed for this query.
     */
    public function setFilterable(array $filterable): self
    {
        $this->filterable = array_merge($filterable, $this->baseFilters);

        return $this;
    }

    /**
     * Clear all filterable definitions.
     */
    public function clearFilterable(): self
    {
        return $this->setFilterable([]);
    }
}