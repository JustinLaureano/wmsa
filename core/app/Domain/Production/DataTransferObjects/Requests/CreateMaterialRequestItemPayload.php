<?php

namespace App\Domain\Production\DataTransferObjects\Requests;

use Spatie\LaravelData\Data;
use App\Domain\Materials\Enums\UnitOfMeasureEnum;

class CreateMaterialRequestItemPayload extends Data
{
    public function __construct(
        public readonly string $material_uuid,
        public readonly int $quantity_requested,
        public readonly string $unit_of_measure,
        public readonly string|null $machine_uuid,
        public readonly string|null $storage_location_uuid
    )
    {

    }

    public static function rules(): array
    {
        return [
            'material_uuid' => [
                'required',
                'exists:materials,uuid'
            ],
            'quantity_requested' => [
                'required',
                'integer',
                'min:0'
            ],
            'unit_of_measure' => [
                'required',
                'string',
                'in:' . implode(',', UnitOfMeasureEnum::cases())
            ],
            'machine_uuid' => [
                'nullable',
                'exists:machines,uuid'
            ],
            'storage_location_uuid' => [
                'nullable',
                'exists:storage_locations,uuid'
            ]
        ];
    }
}
