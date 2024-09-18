<?php

use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Models\MaterialContainer;
use Illuminate\Support\Facades\Route;

Route::get('/barcode', function () {
    $con = MaterialContainer::inRandomOrder()->first();
    $barcode = BarcodeFactory::make($con->barcode);

    return response()->json([
        'string' => $con->barcode,
        'barcode' => $barcode->toArray()
    ]);
});

Route::get('/barcode/create', function () {
    $con = MaterialContainer::factory()->create();

    return response()->json($con);
});
