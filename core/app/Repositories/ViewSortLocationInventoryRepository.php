<?php

namespace App\Repositories;

use App\Models\Views\ViewSortLocationInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ViewSortLocationInventoryRepository
{
    public function filterPaginate() : LengthAwarePaginator
    {
        return ViewSortLocationInventory::query()
            ->filter()
            ->orderBy('part_number', 'asc')
            ->paginate();
    }
}
