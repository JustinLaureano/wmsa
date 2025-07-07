<?php

namespace App\Domain\Locations\Support;

use App\Repositories\BuildingTransferAreaRepository;
use App\Repositories\StorageLocationRepository;
use App\Support\Enums\TimeToLiveEnum;
use Illuminate\Support\Facades\Cache;

class BuildingTransferRouter
{
    public static function getTransferDestinations(int $currentBuildingId, int $destinationBuildingId): array
    {
        $buildingTransferAreaRepository = new BuildingTransferAreaRepository();
        $storageLocationRepository = new StorageLocationRepository();

        $outboundStorageLocationAreaId = $buildingTransferAreaRepository
            ->getOutboundStorageLocationAreaId($currentBuildingId);

        $inboundStorageLocationAreaId = $buildingTransferAreaRepository
            ->getInboundStorageLocationAreaId($destinationBuildingId);

        $inboundStorageLocation = Cache::remember(
            'inbound_storage_locations_' . $inboundStorageLocationAreaId,
            TimeToLiveEnum::ONE_HOUR->value,
            function () use ($storageLocationRepository, $inboundStorageLocationAreaId) {
                return $storageLocationRepository
                    ->getAvailableStorageLocationsByArea($inboundStorageLocationAreaId, 2);
            }
        );

        $outboundStorageLocation = Cache::remember(
            'outbound_storage_locations_' . $outboundStorageLocationAreaId,
            TimeToLiveEnum::ONE_HOUR->value,
            function () use ($storageLocationRepository, $outboundStorageLocationAreaId) {
                return $storageLocationRepository
                    ->getAvailableStorageLocationsByArea($outboundStorageLocationAreaId, 2);
            }
        );

        return [
            'inbound_storage_locations' => $inboundStorageLocation,
            'outbound_storage_locations' => $outboundStorageLocation,
        ];
    }
}
