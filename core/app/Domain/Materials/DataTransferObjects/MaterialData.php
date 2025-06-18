<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialData extends Data
{
    public function __construct(
        public string $material_number,
        public string $part_number,
        public string $description,
        public string|null $material_type_code,
        public float $base_quantity,
        public string $base_unit_of_measure,
        public string|null $material_container_type_id
    ) {

    }
}
