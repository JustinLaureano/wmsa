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
        public int|null $base_container_unit_quantity,
        public string|null $base_unit_of_measure,
        public int|null $expiration_days,
        public int|null $required_degas_hours,
        public int|null $required_hold_hours,
        public bool $requires_completion,
        public string|null $material_container_type_id,
        public bool $service_part,
    ) {

    }
}
