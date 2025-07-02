<?php

namespace App\Repositories;

use App\Models\StorageLocation;
use Illuminate\Support\Collection;

class SortStorageLocationRepository
{
    /**
     * Get all sort list records.
     */
    public function getSortStationByBuilding(int $buildingId) : Collection|null
    {
        return match ($buildingId) {
            1 => StorageLocation::query()
                ->where('name', 'Plant 2 Sort')
                ->get(),
            2 => StorageLocation::query()
                ->where('name', 'Blackhawk Sort')
                ->get(),
            default => null
        };
    }
}
