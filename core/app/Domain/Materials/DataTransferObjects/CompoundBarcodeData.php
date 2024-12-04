<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class CompoundBarcodeData extends Data
{
    public function __construct(
        public readonly string $barcode,
        public readonly string $partNumber,
        public readonly int $quantity,
        public readonly string $clockNumber,
        public readonly string $runNumber,
        public readonly string $expirationDate
    ) {

    }
}
