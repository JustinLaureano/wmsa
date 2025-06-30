<?php

namespace App\Repositories;

use App\Models\Building;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BuildingRepository
{
    public function find(int $id) : Building|null
    {
        return Cache::remember('building_'.$id, 60 * 60 * 24, function () use ($id) {
            return Building::query()
                ->with([
                    'organization',
                    'type',
                ])
                ->find($id);
        });
    }

    public function getBuildingIds() : Collection
    {
        return Cache::remember('building_ids', 60 * 60 * 24, function () {
            return collect(Building::query()->pluck('id'));
        });
    }
}
