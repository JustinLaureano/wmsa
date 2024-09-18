<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class MaterialBarcodeData extends Data
{
    public function __construct(
        public string $barcode,
        public string $partNumber,
        public int $quantity,
        public string $manufactureDate,
        public string $clockNumber,
        public string $supplier,
        public string $time,
        public string $supplierPartNumber,
        public string $lotNumber,
        public string $serialNumber
    ) {

    }
}
