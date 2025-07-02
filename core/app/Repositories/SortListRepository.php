<?php

namespace App\Repositories;

use App\Models\SortList;
use App\Models\Views\ViewSortListPartNumber;
use Illuminate\Support\Collection;

class SortListRepository
{
    /**
     * Get all sort list records.
     */
    public function get() : Collection
    {
        return SortList::query()
            ->with([
                'customer',
                'material',
            ])
            ->orderBy('list_date', 'desc')
            ->get();
    }

    /**
     * Get all sort list part numbers.
     */
    public function getPartNumbers() : Collection
    {
        return ViewSortListPartNumber::query()
            ->get()
            ->pluck('part_number')
            ->values();
    }

    /**
     * Check if a material is on an active sort list.
     */
    public function isActiveMaterial(string $materialUuid) : bool
    {
        return SortList::where('material_uuid', $materialUuid)
            ->where('status', '!=', 'closed')
            ->exists();
    }
}
