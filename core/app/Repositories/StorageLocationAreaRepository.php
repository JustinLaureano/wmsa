<?php

namespace App\Repositories;

use App\Domain\Locations\Enums\BuildingIdEnum;
use App\Models\StorageLocationArea;
use App\Support\Enums\TimeToLiveEnum;
use Illuminate\Support\Facades\Cache;

class StorageLocationAreaRepository
{
    public function getRepackAreaIdsByBuilding(int $buildingId) : \Illuminate\Support\Collection
    {
        $ids = match ($buildingId) {
            1 => StorageLocationArea::query()
                ->where('building_id', BuildingIdEnum::PLANT_2->value)
                ->whereIn('name', [
                    'REPACK'
                ])
                ->pluck('id'),
            2 => StorageLocationArea::query()
                ->where('building_id', BuildingIdEnum::BLACKHAWK->value)
                ->whereIn('name', [
                    'REPACK',
                    'REPACK 2'
                ])
                ->orderBy('name', 'asc')
                ->pluck('id'),
            default => null
        };

        if (!$ids) {
            return collect();
        }

        return Cache::remember(
            'building_id_' . $buildingId . '_repack_area_ids',
            TimeToLiveEnum::ONE_DAY->value,
            function () use ($ids) {
                return $ids;
            }
        );
    }
}
