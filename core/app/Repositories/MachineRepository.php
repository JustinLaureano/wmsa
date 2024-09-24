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
}
