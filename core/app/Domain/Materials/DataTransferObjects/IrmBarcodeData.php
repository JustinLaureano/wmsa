<?php

namespace App\Domain\Materials\DataTransferObjects;

use Spatie\LaravelData\Data;

class IrmBarcodeData extends Data
{
    public function __construct(
        public readonly string $barcode,
        public readonly string $partNumber,
        public readonly int|null $quantity,
        public readonly string $clockNumber,
        public readonly string $runNumber,
        public readonly string $expirationDate
    ) {

    }
}
