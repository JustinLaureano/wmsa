<?php

use App\Http\Controllers\Production\ViewProductionRequests;
use App\Http\Controllers\Production\CreateNewMaterialRequestPage;
use Illuminate\Support\Facades\Route;

Route::get('production/requests', ViewProductionRequests::class)
    ->name('production.requests');

Route::middleware('auth')->group(function () {
    Route::get('production/material-request/new', CreateNewMaterialRequestPage::class)
        ->name('production.material-request.new');
});
