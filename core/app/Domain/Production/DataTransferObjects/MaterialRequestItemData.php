<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialRequestItemData extends Data
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $material_request_uuid,
        public readonly string $material_uuid,
        public readonly int $quantity_requested,
        public readonly int $quantity_delivered,
        public readonly string $unit_of_measure,
        public readonly string|null $machine_uuid,
        public readonly string|null $storage_location_uuid,
        public readonly string $request_item_status_code,
    )
    {

    }
}
