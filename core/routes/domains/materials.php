<?php

use App\Http\Controllers\Materials\CreateMaterialPage;
use App\Http\Controllers\Materials\GetMaterialInventory;
use Illuminate\Support\Facades\Route;

Route::get('materials/inventory', GetMaterialInventory::class)
    ->name('materials.inventory');

Route::middleware('auth')->group(function () {
    Route::get('materials/create', CreateMaterialPage::class)
        ->name('materials.create');
});

Route::middleware('auth:teammate')->group(function () {
    //
});
