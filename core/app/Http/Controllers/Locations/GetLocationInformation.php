<?php

namespace App\Http\Controllers\Locations;

use App\Domain\Locations\Actions\HandleBarcodeScanAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Locations\StorageLocationInformationResource;

class GetLocationInformation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $barcode, HandleBarcodeScanAction $action)
    {
        $location = $action->handle(base64_decode($barcode));

        return new StorageLocationInformationResource($location);
    }
}
