<?php

use App\Http\Controllers\Locations\ViewStorageLocations;
use App\Http\Controllers\Locations\ViewWarehouseKpi;
use Illuminate\Support\Facades\Route;

Route::get('locations/buildings/kpi', ViewWarehouseKpi::class)
    ->name('locations.buildings.kpi');

Route::get('locations/show', ViewStorageLocations::class)
    ->name('locations.show');

Route::middleware('auth')->group(function () {
    //
});
