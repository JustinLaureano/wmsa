<?php

namespace App\Http\Controllers\Materials;

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

        return response()
            ->json([
                'barcode' => $barcode ? $barcode->toArray() : null
            ]);
    }
}
