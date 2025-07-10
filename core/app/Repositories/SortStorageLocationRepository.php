<?php

namespace App\Repositories;

use App\Models\StorageLocation;

class SortStorageLocationRepository
{
    /**
     * Get all sort list records.
     */
    public function getSortStationByBuilding(int $buildingId) : StorageLocation|null
    {
        return match ($buildingId) {
            1 => StorageLocation::query()
                ->where('name', 'Plant 2 Sort')
                ->first(),
            2 => StorageLocation::query()
                ->where('name', 'Blackhawk Sort')
                ->first(),
            default => null
        };
    }
}
