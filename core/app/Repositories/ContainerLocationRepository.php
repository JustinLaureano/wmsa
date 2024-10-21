<?php

namespace App\Repositories;

use App\Domain\Materials\DataTransferObjects\ContainerLocationData;
use App\Models\ContainerLocation;

class ContainerLocationRepository
{
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
