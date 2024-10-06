<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialContainerData extends Data
{
    public function __construct(
        public readonly string $material_uuid,
        public readonly ?int $material_container_type_id,
        public readonly ?string $storage_location_uuid,
        public readonly int $movement_status_id,
        public readonly string $barcode,
        public readonly int $quantity
    ) {

    }
}
