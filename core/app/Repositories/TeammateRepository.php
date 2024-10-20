<?php

namespace App\Repositories;

use App\Models\Teammate;
use Illuminate\Database\Eloquent\Collection;

class TeammateRepository
{
    public function findByClockNumber(string $clockNumber) : Teammate|null
    {
        return Teammate::query()->whereClockNumber($clockNumber)->first();
    }

    public function get() : Collection
    {
        return Teammate::query()->get();
    }
}
