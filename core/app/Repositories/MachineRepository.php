<?php

namespace App\Repositories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class MachineRepository
{
    /**
     * Retrieve all machines.
     */
    public function get($sortBy = 'name', $sortOrder = 'asc') : Collection
    {
        return Machine::query()
            ->orderBy($sortBy, $sortOrder)
            ->get();
    }

    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        if ($search === null) {
            $search = request()->query('search');
        }

        return Machine::search($search)
            ->query(fn (Builder $query) => $query->filter())
            ->paginate();
    }

    /**
     * Find a machine by its UUID.
     */
    public function findByUuid(string $uuid) : Machine|null
    {
        return Machine::query()->whereUuid($uuid)->first();
    }
}
