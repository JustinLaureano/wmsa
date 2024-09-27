<?php

namespace App\Repositories;

use App\Models\RackLocation;

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

    public function findEmptyByArea(string $area, int $building) : RackLocation
    {
        return RackLocation::where([
                ['area', $area],
                ['building', $building]
            ])
            ->first();
    }
}