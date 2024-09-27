<?php

namespace App\Repositories;

use App\Models\RackLocation;
use App\Models\RackLocationAlloted;
use App\Models\SkidLocation;

class RackLocationRepository
{
    public function getReceivingDock() : RackLocation
    {
        return $this->findById('RECEIVING DOCK');
    }

    public function findById(string $id) : RackLocation
    {
        return RackLocation::where('id', $id)->first();
    }

    public function findEmptyByArea(string $area, int $building) : RackLocation|null
    {
        $fullLocations = SkidLocation::select('location_srlnum')
            ->pluck('location_srlnum')
            ->toArray();

        $disabledLocations = RackLocation::select('id')
            ->where('disabled', 1)
            ->pluck('id')
            ->toArray();

        $allottedLocations = RackLocationAlloted::select('location_srlnum')
            ->distinct()
            ->pluck('location_srlnum')
            ->toArray();

        $invalidLocations = array_merge($fullLocations, $disabledLocations, $allottedLocations);

        return RackLocation::where([
                ['area', $area],
                ['building', $building]
            ])
            ->where('exclude_allocations', 0)
            ->whereNotIn('id', $invalidLocations)
            ->orderBy('aisle', 'ASC')
            ->orderBy('bay', 'ASC')
            ->orderBy('shelf', 'ASC')
            ->orderBy('position', 'ASC')
            ->first();
    }
}