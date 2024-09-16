<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialData extends Data
{
    public function __construct(
        public string $material_number,
        public string $part_number,
        public string $description,
        public float $base_quantity,
        public string $base_unit_of_measure
    ) {

    }
}
