<?php

namespace App\Repositories;

use App\Models\Part;
use Illuminate\Database\Eloquent\Collection;

class PartRepository
{
    public function get() : Collection
    {
        return Part::get();
    }
}