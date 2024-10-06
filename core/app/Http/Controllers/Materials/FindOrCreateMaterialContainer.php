<?php

namespace App\Http\Controllers\Materials;

use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Http\Controllers\Controller;
use App\Repositories\MaterialContainerRepository;

class FindOrCreateMaterialContainer extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected MaterialContainerRepository $containerRepository,
    ) {
        //
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(string $barcode)
    {
        $barcode = BarcodeFactory::make(base64_decode($barcode));
        $container = (new MaterialContainerRepository)->findOrCreate($barcode);

        return response()->json(['container' => $container]);
    }
}
