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

    /**
     * Get the area id for the toyota rack.
     */
    public function getToyotaRackAreaId(): int
    {
        return Cache::remember(
            'toyota_rack_area_id',
            TimeToLiveEnum::ONE_DAY->value,
            function () {
                return StorageLocationArea::query()
                    ->where('name', 'TOY')
                    ->first()
                    ->id;
            }
        );
    }

    /**
     * Get the area id for a given building and area name.
     */
    public function getRackAreaId(int $buildingId, string $area): int
    {
        return Cache::remember(
            'building_id_' . $buildingId . '_'. $area .'_storage_location_area_id',
            TimeToLiveEnum::ONE_DAY->value,
            function () use ($buildingId, $area) {
                return StorageLocationArea::query()
                    ->where('building_id', $buildingId)
                    ->where('name', $area)
                    ->first()
                    ->id;
            }
        );
    }
}
