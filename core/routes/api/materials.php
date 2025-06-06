<?php

use App\Http\Controllers\Materials\FindOrCreateMaterialContainer;
use App\Http\Controllers\Materials\GetBarcodeInformation;
use App\Http\Controllers\Materials\InitiateContainerMovement;
use App\Http\Controllers\Materials\ViewMaterials;
use Illuminate\Support\Facades\Route;

Route::get('/materials', ViewMaterials::class)
    ->name('api.materials');

Route::get('/materials/barcode/{barcode}', GetBarcodeInformation::class)
    ->name('api.barcode.information');

Route::get('/materials/container/{barcode}', FindOrCreateMaterialContainer::class)
    ->name('api.materials.container');

Route::middleware('auth')->group(function () {
    Route::post('/materials/container-movement', InitiateContainerMovement::class)
        ->name('api.container.movement');
});
