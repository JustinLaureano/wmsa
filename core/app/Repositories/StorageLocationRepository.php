<?php

namespace App\Repositories;

use App\Domain\Locations\Enums\CompletionStationEnum;
use App\Domain\Locations\Enums\DegasAreaEnum;
use App\Models\StorageLocation;
use App\Support\Enums\TimeToLiveEnum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class StorageLocationRepository
{
    public function filterPaginate() : LengthAwarePaginator
    {
        return StorageLocation::query()
            ->filter()
            ->orderBy('name', 'asc')
            ->paginate();
    }

    public function findByUuid(string $uuid) : StorageLocation
    {
        return StorageLocation::query()->whereUuid($uuid)->first();
    }

    public function findByBarcode(string $barcode) : StorageLocation
    {
        return StorageLocation::query()->whereBarcode($barcode)->first();
    }

    public function get() : Collection
    {
        return StorageLocation::query()->get();
    }

    public function getAvailableStorageLocationsByArea(int $areaId, int|null $max = 10) : Collection
    {
        $records = DB::select('CALL get_available_storage_locations_by_area(?, ?)', [$areaId, $max]);

        $storageLocations = StorageLocation::hydrate($records)->load('area.building');

        return $storageLocations;
    }

    public function getCompletionStationByBuilding(int $buildingId) : StorageLocation|null
    {
        return Cache::remember(
            'building_id_' . $buildingId . '_completion_station',
            TimeToLiveEnum::ONE_DAY->value,
            function () use ($buildingId) {
                return match ($buildingId) {
                    1 => StorageLocation::query()
                        ->where('name', CompletionStationEnum::PLANT_2->value)
                        ->first(),
                    2 => StorageLocation::query()
                        ->where('name', CompletionStationEnum::BLACKHAWK->value)
                        ->first(),
                    default => null
                };
            }
        );
    }

    public function getDegasAreaIds() : \Illuminate\Support\Collection
    {
        return Cache::remember(
            'degas_area_ids',
            TimeToLiveEnum::ONE_DAY->value,
            function () {
                return StorageLocation::query()
                    ->whereIn('name', [
                            DegasAreaEnum::DEGAS_OVEN->value,
                            DegasAreaEnum::DEGAS_OVEN_2->value,
                        ])
                        ->pluck('storage_location_area_id');
                    }
        );
    }

    /**
     * Find a machine staging location by its barcode.
     */
    public function getStagingLocationByMachine(string $machineBarcode) : StorageLocation|null
    {
        return StorageLocation::query()
            ->where('barcode', $machineBarcode)
            ->with('area.building')
            ->first();
    }
}
