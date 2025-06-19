<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialData extends Data
{
    public function __construct(
        public string|null $material_number,
        public string|null $part_number,
        public string|null $description,
        public string|null $material_type_code,
        public float|null $base_quantity,
        public string|null $base_unit_of_measure,
        public string|null $material_container_type_id
    ) {

    }
}
