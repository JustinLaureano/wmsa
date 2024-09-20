<?php

use App\Http\Controllers\Locations\ViewWarehouseKpi;
use Illuminate\Support\Facades\Route;

Route::get('locations/buildings/kpi', ViewWarehouseKpi::class)
    ->name('locations.buildings.kpi');

Route::middleware('auth')->group(function () {
    //
});

Route::middleware('auth:teammate')->group(function () {
    //
});
