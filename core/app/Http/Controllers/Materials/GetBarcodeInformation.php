<?php

namespace App\Http\Controllers\Materials;

use App\Http\Resources\Materials\MaterialBarcodeResource;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Http\Controllers\Controller;

class GetBarcodeInformation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $barcode)
    {
        $barcode = BarcodeFactory::make(base64_decode($barcode));

        return new MaterialBarcodeResource($barcode);
    }
}
