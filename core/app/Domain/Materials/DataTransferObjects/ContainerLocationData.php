<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class ContainerLocationData extends Data
{
    public function __construct(
        public readonly string $material_container_uuid,
        public readonly string $storage_location_uuid
    ) {

    }
}
