<?php

namespace App\Domain\Locations\DataTransferObjects;

use Spatie\LaravelData\Data;

class StorageLocationAreaData extends Data
{
    public function __construct(
        public int $building_id,
        public string $name,
        public string $description,
        public string $sap_storage_location_group
    ) {

    }
}
