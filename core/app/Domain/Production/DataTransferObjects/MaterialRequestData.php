<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialRequestData extends Data
{
    public function __construct(
        public readonly string $material_uuid,
        public readonly string $quantity,
        public readonly string $unit_of_measure,
        public readonly string $machine_uuid,
        public readonly string $storage_location_uuid,
        public readonly string $material_request_status_code,
        public readonly string $requester_user_uuid,
        public readonly string $requested_at
    )
    {

    }
}