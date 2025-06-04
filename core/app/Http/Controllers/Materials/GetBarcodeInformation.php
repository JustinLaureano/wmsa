<?php

namespace App\Http\Controllers\Materials;

use App\Domain\Materials\Actions\HandleBarcodeScanAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Materials\BarcodeInformationResource;

class GetBarcodeInformation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $barcode, HandleBarcodeScanAction $action)
    {
        $action->handle(base64_decode($barcode));

        return new BarcodeInformationResource($action);
    }
}
