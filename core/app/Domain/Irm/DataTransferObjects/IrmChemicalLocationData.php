<?php

namespace App\Domain\Irm\DataTransferObjects;

use Spatie\LaravelData\Data;

class IrmChemicalLocationData extends Data
{
    public function __construct(
        public string $irm_chemical_uuid,
        public string $storage_location_uuid,
        public int $quantity
    ) {

    }
}
