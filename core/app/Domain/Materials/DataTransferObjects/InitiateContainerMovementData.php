<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class InitiateContainerMovementData extends Data
{
    public function __construct(
        public readonly string $material_container_uuid,
        public readonly string $storage_location_uuid,
        public readonly string $clock_number
    ) {

    }

    public static function rules(): array
    {
        return [
            'material_container_uuid' => ['required', 'exists:material_containers,uuid'],
            'storage_location_uuid' => ['required', 'exists:storage_locations,uuid'],
            'clock_number' => ['required', 'exists:teammates,clock_number'],
        ];
    }
}
