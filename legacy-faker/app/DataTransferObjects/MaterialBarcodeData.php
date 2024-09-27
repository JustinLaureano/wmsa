<?php

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialBarcodeData extends Data
{
    public function __construct(
        public readonly string $barcode,
        public readonly string $partNumber,
        public readonly int $quantity,
        public readonly string $manufactureDate,
        public readonly string $clockNumber,
        public readonly string $supplier,
        public readonly string $time,
        public readonly string $supplierPartNumber,
        public readonly string $lotNumber,
        public readonly string $serialNumber
    ) {

    }
}
