<?php

namespace App\Domain\Materials\DataTransferObjects;

use App\Domain\Materials\Rules\HandlerExists;
use Spatie\LaravelData\Data;

class InitiateContainerMovementData extends Data
{
    public function __construct(
        public readonly string $material_container_uuid,
        public readonly string $storage_location_uuid,
        public readonly string $handler_user_uuid,
        public readonly string $moved_at,
    ) {

    }

    public static function rules(): array
    {
        return [
            'material_container_uuid' => [
                'required',
                'exists:material_containers,uuid'
            ],
            'storage_location_uuid' => [
                'required',
                'exists:storage_locations,uuid'
            ],
            'handler_user_uuid' => [
                'required',
                new HandlerExists
            ],
            'moved_at' => [
                'required',
                'date'
            ],
        ];
    }
}
