<?php

namespace App\Repositories;

use App\Models\StorageLocation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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
}
