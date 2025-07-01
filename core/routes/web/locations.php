<?php

use App\Http\Controllers\Locations\ShowStorageLocation;
use App\Http\Controllers\Locations\ViewStorageLocations;
use App\Http\Controllers\Locations\ViewWarehouseKpi;
use Illuminate\Support\Facades\Route;

Route::get('locations/buildings/kpi', ViewWarehouseKpi::class)
    ->name('locations.buildings.kpi');

Route::get('locations', ViewStorageLocations::class)
    ->name('locations.index');

Route::middleware('auth')->group(function () {
    Route::get('locations/{storageLocation:uuid}', ShowStorageLocation::class)
        ->name('locations.show');
});
