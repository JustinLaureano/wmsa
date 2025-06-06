<?php

namespace App\Domain\Locations\Actions;

use App\Models\StorageLocation;
use App\Repositories\StorageLocationRepository;

class HandleBarcodeScanAction
{
    public function handle(string $barcode) : StorageLocation
    {
        return (new StorageLocationRepository)->findByBarcode($barcode);
    }
}
