<?php

namespace App\Domain\Locations\DataTransferObjects;

use Spatie\LaravelData\Data;

class StorageLocationData extends Data
{
    public function __construct(
        public string $name,
        public string $barcode,
        public int $storage_location_type_id,
        public int $storage_location_area_id,
        public int $aisle,
        public int $bay,
        public int $shelf,
        public int $position,
        public int|null $max_containers,
        public int $restrict_request_allocations = 0,
        public int $disabled,
        public int $reservable
    ) {

    }
}
