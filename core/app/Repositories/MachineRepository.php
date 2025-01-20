<?php

namespace App\Repositories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * Find a machine by its UUID.
     */
    public function findByUuid(string $uuid) : Machine|null
    {
        return Machine::query()->whereUuid($uuid)->first();
    }
}
