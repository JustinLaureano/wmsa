<?php

use App\Http\Controllers\Production\ViewProductionRequests;
use App\Http\Controllers\Production\ViewNewMaterialRequestForm;
use Illuminate\Support\Facades\Route;

Route::get('production/requests', ViewProductionRequests::class)
    ->name('production.requests');

Route::middleware('auth')->group(function () {
    Route::get('production/material-request/new', ViewNewMaterialRequestForm::class)
        ->name('production.material-request.new');
});
