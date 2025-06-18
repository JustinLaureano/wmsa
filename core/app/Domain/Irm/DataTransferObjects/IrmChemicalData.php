<?php

namespace App\Domain\Irm\DataTransferObjects;

use Spatie\LaravelData\Data;

class IrmChemicalData extends Data
{
    public function __construct(
        public int $id,
        public string $material_uuid,
        public int $lot_quantity,
        public int $unit_quantity,
        public string|null $assigned_storage_location_uuid,
        public string|null $drop_off_storage_location_uuid
    ) {

    }
}
