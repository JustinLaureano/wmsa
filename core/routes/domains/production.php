<?php

use App\Http\Controllers\Production\GetProductionRequests;
use App\Http\Controllers\Production\CreateRequestPage;
use Illuminate\Support\Facades\Route;

Route::get('production/requests', GetProductionRequests::class)
    ->name('production.requests');

Route::middleware('auth')->group(function () {
    //
});

Route::middleware('auth:teammate')->group(function () {

    Route::get('production/requests/create', CreateRequestPage::class)
        ->name('production.requests.create');

});
