<?php

use App\Http\Controllers\Materials\ViewMaterials;
use App\Http\Controllers\Materials\GetMaterialInventory;
use Illuminate\Support\Facades\Route;

Route::get('materials/inventory', GetMaterialInventory::class)
    ->name('materials.inventory');

Route::middleware('auth')->group(function () {
    Route::get('materials', ViewMaterials::class)
        ->name('materials');
});

Route::middleware('auth:teammate')->group(function () {
    //
});
