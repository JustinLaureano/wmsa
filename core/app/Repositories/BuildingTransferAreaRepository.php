<?php

namespace App\Repositories;

use App\Models\BuildingTransferArea;

class BuildingTransferAreaRepository
{
    public function getInboundStorageLocationAreaId(int $buildingId): int|null
    {
        return BuildingTransferArea::query()
            ->where('building_id', $buildingId)
            ->first()
            ?->inbound_storage_location_area_id;
    }

    public function getOutboundStorageLocationAreaId(int $buildingId): int|null
    {
        return BuildingTransferArea::query()
            ->where('building_id', $buildingId)
            ->first()
            ?->outbound_storage_location_area_id;
    }
}
