<?php

use App\Http\Controllers\Irm\ViewChemicals;
use App\Http\Controllers\Irm\GetIrmInventory;
use Illuminate\Support\Facades\Route;

Route::get('irm/chemicals.inventory', GetIrmInventory::class)
    ->name('irm.chemicals.inventory');

Route::middleware('auth')->group(function () {
    Route::get('irm.chemicals', ViewChemicals::class)
        ->name('irm.chemicals');
});

Route::middleware('auth:teammate')->group(function () {
    //
});
