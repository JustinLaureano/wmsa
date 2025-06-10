<?php

namespace App\Repositories;

use App\Models\Views\ViewSortListInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ViewSortListInventoryRepository
{
    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        if ($search === null) {
            $search = request()->query('search');
        }

        return ViewSortListInventory::search($search)
            ->query(fn (Builder $query) => $query->filter())
            ->orderBy('part_number', 'asc')
            ->paginate();
    }
}
