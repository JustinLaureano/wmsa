<?php

namespace App\Repositories;

use App\Models\Views\ViewContainerInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ViewContainerInventoryRepository
{
    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        if ($search === null) {
            $search = request()->query('search');
        }

        return ViewContainerInventory::search($search)
            ->query(fn (Builder $query) => $query->filter())
            ->orderBy('part_number', 'asc')
            ->paginate();
    }
}
