<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;

class InitiateMaterialRequestData extends Data
{
    public function __construct(
        public readonly string $part_number,
        public readonly int $quantity,
        public readonly string $unit_of_measure,
        public readonly string|null $machine_uuid,
        public readonly string|null $storage_location_uuid,
        public readonly string $requester_user_uuid,
        public readonly string $requested_at,
    )
    {

    }

    public static function rules(): array
    {
        return [
            'part_number' => [
                'required',
                'exists:materials,part_number'
            ],
            'quantity' => [
                'required',
                'integer'
            ],
            'unit_of_measure' => [
                'required',
                'string',
                'min:1'
            ],
            'machine_uuid' => [
                'nullable',
                'exists:machines,uuid'
            ],
            'storage_location_uuid' => [
                'nullable',
                'exists:storage_locations,uuid'
            ],
            'requester_user_uuid' => [
                'required',
                'exists:users,uuid'
            ],
            'requested_at' => [
                'required',
                'date'
            ],
        ];
    }
}