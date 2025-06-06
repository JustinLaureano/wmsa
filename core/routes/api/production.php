<?php

use App\Http\Controllers\Materials\InitiateContainerMovement;
use App\Http\Controllers\Production\CreateMaterialRequest;
use App\Http\Controllers\Production\CompleteMaterialRequest;
use App\Http\Controllers\Production\CancelMaterialRequest;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/production/material-request', CreateMaterialRequest::class)
        ->name('api.production.material-request');

    Route::put('/production/material-request/{uuid}/complete', CompleteMaterialRequest::class)
        ->name('api.production.material-request.complete');

    Route::put('/production/material-request/{uuid}/cancel', CancelMaterialRequest::class)
        ->name('api.production.material-request.cancel');
});
