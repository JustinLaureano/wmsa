<?php

use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Http\Controllers\LocalizationController;
use App\Models\MaterialContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user')
    ->middleware('auth:sanctum');


Route::post('/localization', [LocalizationController::class, 'set'])->name('localization');







/** Test routes */

Route::get('/barcode', function () {
    $con = MaterialContainer::inRandomOrder()->first();
    $barcode = BarcodeFactory::create($con->barcode);

    return response()->json([
        'string' => $con->barcode,
        'barcode' => $barcode->toArray()
    ]);
});
