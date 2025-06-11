<?php

namespace App\Repositories;

use App\Models\Views\ViewSortListInventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class ViewSortListInventoryRepository
{
    public function filterPaginate($search = null) : LengthAwarePaginator
    {
        $buildingId = request()->query('storage_location_building_id');

        return ViewSortListInventory::query()
            ->filter()
            ->when($buildingId, function (Builder $query) use ($buildingId) {
                $query->where('storage_location_building_id', $buildingId);
            })
            ->orderBy('part_number', 'asc')
            ->paginate();
    }
}
