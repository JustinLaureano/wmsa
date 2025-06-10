<?php

namespace App\Repositories;

use App\Models\SortList;
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

    public function getPartNumbers() : Collection
    {
        return SortList::query()
            ->with('material')
            ->get()
            ->pluck('material.part_number')
            ->unique()
            ->sort()
            ->values();
    }
}