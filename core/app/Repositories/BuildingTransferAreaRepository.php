<?php

namespace App\Repositories;

use App\Models\BuildingTransferArea;
use App\Support\Enums\TimeToLiveEnum;
use Illuminate\Support\Facades\Cache;

class BuildingTransferAreaRepository
{
    public function getInboundStorageLocationAreaId(int $buildingId): int|null
    {
        return Cache::remember(
            'building_' . $buildingId . '_inbound_storage_location_area_id',
            TimeToLiveEnum::ONE_HOUR->value,
            function () use ($buildingId) {
                return BuildingTransferArea::query()
                    ->where('building_id', $buildingId)
                    ->first()
                    ?->inbound_storage_location_area_id;
        });
    }

    public function getOutboundStorageLocationAreaId(int $buildingId): int|null
    {
        return Cache::remember(
            'building_' . $buildingId . '_outbound_storage_location_area_id',
            TimeToLiveEnum::ONE_HOUR->value,
            function () use ($buildingId) {
                return BuildingTransferArea::query()
                    ->where('building_id', $buildingId)
                    ->first()
                    ?->outbound_storage_location_area_id;
        });
    }
}
