<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialContainerData extends Data
{
    public function __construct(
        public readonly string $material_uuid,
        public readonly ?int $material_container_type_id,
        public readonly ?string $material_tote_type_uuid,
        public readonly string $movement_status_code,
        public readonly string $barcode,
        public readonly string|null $lot_number,
        public readonly int $quantity,
        public readonly string $expiration_date
    ) {

    }
}
