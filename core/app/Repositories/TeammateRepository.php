<?php

namespace App\Repositories;

use App\Models\Teammate;
use Illuminate\Database\Eloquent\Collection;

class TeammateRepository
{
    public function get() : Collection
    {
        return Teammate::query()->get();
    }
}
