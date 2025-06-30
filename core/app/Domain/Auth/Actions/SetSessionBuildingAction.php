<?php

namespace App\Domain\Auth\Actions;

use App\Models\Building;
use App\Repositories\BuildingRepository;

class SetSessionBuildingAction
{
    public function handle(int $building_id) : Building|null
    {
        session([ 'building_id' => $building_id ]);

        $building = (new BuildingRepository)->find($building_id);

        return $building;
    }
}
