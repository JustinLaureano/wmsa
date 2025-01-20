<?php

namespace App\Repositories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Collection;

class MachineRepository
{
    public function get() : Collection
    {
        return Machine::query()->get();
    }

    public function findByUuid(string $uuid) : Machine|null
    {
        return Machine::query()->whereUuid($uuid)->first();
    }
}
