<?php

namespace App\Repositories;

use App\Models\Views\ViewMaterialInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ViewMaterialInventoryRepository
{
    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        if ($search === null) {
            $search = request()->query('search');
        }

        return ViewMaterialInventory::search($search)
            ->query(fn (Builder $query) => $query->filter())
            ->paginate();
    }
}
