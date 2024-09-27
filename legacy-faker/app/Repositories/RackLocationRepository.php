<?php

namespace App\Repositories;

use App\Models\RackLocation;

class RackLocationRepository
{
    public function getReceivingDock() : RackLocation
    {
        return RackLocation::where('id', 'RECEIVING DOCK')->first();
    }
}