<?php

namespace App\Domain\Materials\Transformers;

use App\Domain\Materials\DataTransferObjects\ContainerMovementData;
use App\Domain\Materials\DataTransferObjects\InitiateContainerMovementData;
use App\Domain\Materials\Resolvers\HandlerResolver;
use App\Repositories\MaterialContainerRepository;
use App\Repositories\StorageLocationRepository;
use Carbon\Carbon;

class ContainerMovementTransformer
{
    public static function initiateToData(InitiateContainerMovementData $data) : ContainerMovementData
    {
        $container = (new MaterialContainerRepository)->findByUuid($data->material_container_uuid);
        $location = (new StorageLocationRepository)->findByUuid($data->storage_location_uuid);
        $handler = HandlerResolver::getHandler($data->handler_user_uuid);
        $movedAt = new Carbon($data->moved_at);

        return new ContainerMovementData(
            container: $container,
            location: $location,
            handler: $handler,
            moved_at: $movedAt
        );
    }
}
