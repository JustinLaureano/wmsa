<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;
use App\Domain\Production\Enums\RequestItemStatusEnum;
use App\Domain\Materials\Enums\UnitOfMeasureEnum;

class MaterialRequestItemActionData extends Data
{
    public function __construct(
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
            'quantity_delivered' => [
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
            ],
            'request_item_status_code' => [
                'required',
                'string',
                'in:' . implode(',', RequestItemStatusEnum::cases())
            ]
        ];
    }
}
