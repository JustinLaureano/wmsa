<?php

namespace App\Repositories;

use App\Domain\Materials\DataTransferObjects\ContainerLocationData;
use App\Models\ContainerLocation;
use App\Models\StorageLocation;

class ContainerLocationRepository
{
    public function getContainerLocation(string $containerUuid): StorageLocation|null
    {
        return ContainerLocation::query()
            ->where('material_container_uuid', $containerUuid)
            ->first()
            ?->storageLocation;
    }

    /**
     * Store a container location record for a material container.
     */
    public function store(ContainerLocationData $data) : ContainerLocation
    {
        $attributes = ['material_container_uuid' => $data->material_container_uuid];
        $values = ['storage_location_uuid' => $data->storage_location_uuid];

        return ContainerLocation::query()->updateOrCreate($attributes, $values);
    }
}
