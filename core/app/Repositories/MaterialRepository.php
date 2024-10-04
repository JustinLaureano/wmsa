<?php

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MaterialRepository
{
    public function get() : Collection
    {
        return Material::query()->get();
    }

    public function paginate() : LengthAwarePaginator
    {
        return Material::query()->paginate();
    }
}
