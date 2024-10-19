<?php

namespace App\Domain\Materials\Transformers;

use App\Domain\Materials\DataTransferObjects\ContainerMovementData;
use App\Domain\Materials\DataTransferObjects\InitiateContainerMovementData;
use App\Repositories\MaterialContainerRepository;
use App\Repositories\StorageLocationRepository;
use App\Repositories\TeammateRepository;

class ContainerMovementTransformer
{
    public static function initiateToData(InitiateContainerMovementData $data) : ContainerMovementData
    {
        $container = (new MaterialContainerRepository)->findByUuid($data->material_container_uuid);
        $location = (new StorageLocationRepository)->findByUuid($data->storage_location_uuid);
        $handler = (new TeammateRepository)->findByClockNumber($data->clock_number);

        return new ContainerMovementData(
            container: $container,
            location: $location,
            handler: $handler
        );
    }
}
