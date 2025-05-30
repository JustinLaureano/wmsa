<?php

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class MaterialRepository
{
    public function get() : Collection
    {
        return Material::query()->get();
    }

    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        if ($search === null) {
            $search = request()->query('search');
        }

        return Material::search($search)
            ->query(fn (Builder $query) => $query->filter())
            ->paginate();
    }

    /**
     * Filter the inventory paginate.
     */
    public function filterInventoryPaginate() : LengthAwarePaginator
    {
        return Material::query()
            ->has('containers')
            ->with('containers')
            ->filter()
            ->orderBy('part_number', 'asc')
            ->paginate();
    }

    public function findByPartNumber(string $partNumber) : Material|null
    {
        return Material::query()->wherePartNumber($partNumber)->first();
    }

    public function findByUuid(string $uuid) : Material|null
    {
        return Material::query()->whereUuid($uuid)->first();
    }
}
