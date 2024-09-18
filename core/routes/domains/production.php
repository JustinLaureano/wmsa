<?php

use App\Http\Controllers\GetProductionRequests;
use Illuminate\Support\Facades\Route;

Route::get('production/requests', GetProductionRequests::class)
    ->name('production.requests');

Route::middleware('auth')->group(function () {
    //
});

Route::middleware('auth:teammate')->group(function () {
    //
});
