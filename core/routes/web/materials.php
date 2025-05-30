<?php

use App\Http\Controllers\Materials\ViewMaterials;
use App\Http\Controllers\Materials\GetContainerInventory;
use App\Http\Controllers\Materials\GetMaterialInventory;
use App\Http\Controllers\Materials\ShowMaterial;
use Illuminate\Support\Facades\Route;

Route::get('containers/inventory', GetContainerInventory::class)
    ->name('containers.inventory');

Route::get('materials/inventory', GetMaterialInventory::class)
    ->name('materials.inventory');

Route::middleware('auth')->group(function () {
    Route::get('materials', ViewMaterials::class)
        ->name('materials');

    Route::get('materials/{material}', ShowMaterial::class)
        ->name('materials.show');
});
