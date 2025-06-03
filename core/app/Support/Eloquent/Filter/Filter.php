<?php

namespace App\Support\Eloquent\Filter;

use App\Support\Eloquent\Filter\Contracts\QueryFilter;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{
    const OPERATOR_SEPARATOR = ':';
    const SORT_BY = 'sortBy';

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

        $this->handleSortByFilter($query, $request);

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
     * Add a sort by clause to the query if appropriate.
     */
    protected function handleSortByFilter(Builder $query, Request $request) : void
    {
        if ( !$request->has(static::SORT_BY) ) return;

        $rule = new Rules\SortBy;

        $rule($query, static::SORT_BY, $request->query(static::SORT_BY));
    }

    /**
     * Parse the filter rule from the string if there is one.
     */
    protected function getFilterRule(string|array $filter) : QueryFilter
    {
        if (is_array($filter)) {
            $rule = new Rules\In;
            return $rule;
        }

        if ( !str_contains($filter, static::OPERATOR_SEPARATOR) ) {
            $rule = $this->rules[$this->defaultRule];
            return new $rule;
        }

        [$operator] = explode(static::OPERATOR_SEPARATOR, $filter);

        $rule = $this->rules[$operator] ?? $this->rules[$this->defaultRule];

        return new $rule;
    }

    /**
     * Parse the filter value from the filter string.
     */
    protected function getFilterValue(string|array $filter) : string|array
    {
        if (is_array($filter)) {
            return $filter;
        }

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
        $this->filterable = $filterable;

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