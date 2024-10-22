<?php

namespace App\Domain\Materials\DataTransferObjects;

use App\Domain\Materials\Enums\HandlerTypeEnum;
use App\Domain\Materials\Rules\HandlerExists;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class InitiateContainerMovementData extends Data
{
    public function __construct(
        public readonly string $material_container_uuid,
        public readonly string $storage_location_uuid,
        public readonly string $handler_type,
        public readonly string $handler_id,
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
            'handler_type' => [
                'required',
                Rule::in(HandlerTypeEnum::toArray())
            ],
            'handler_id' => [
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
