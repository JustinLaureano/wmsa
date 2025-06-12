<?php

namespace App\Repositories;

use App\Models\Views\ViewSortListInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ViewSortListInventoryRepository
{
    public function filterPaginate() : LengthAwarePaginator
    {
        return ViewSortListInventory::query()
            ->filter()
            ->orderBy('part_number', 'asc')
            ->paginate();
    }
}
