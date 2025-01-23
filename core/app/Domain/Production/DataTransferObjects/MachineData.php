<?php

namespace App\Domain\Production\DataTransferObjects;

use Spatie\LaravelData\Data;

class MachineData extends Data
{
    public function __construct(
        public string $name,
        public string $barcode,
        public int $building_id,
        public int $machine_type_id,
        public int $restrict_request_allocations,
        public int $disabled
    ) {

    }
}
