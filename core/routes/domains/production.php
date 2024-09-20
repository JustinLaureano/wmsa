<?php

use App\Http\Controllers\Production\GetProductionRequests;
use App\Http\Controllers\Production\CreateRequest;
use Illuminate\Support\Facades\Route;

Route::get('production/requests', GetProductionRequests::class)
    ->name('production.requests');

Route::middleware('auth')->group(function () {
    //
});

Route::middleware('auth:teammate')->group(function () {

    Route::get('production/requests/create', CreateRequest::class)
        ->name('production.requests.create');

});
