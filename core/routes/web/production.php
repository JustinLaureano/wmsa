<?php

use App\Http\Controllers\Production\PutAwayMaterialContainerPage;
use App\Http\Controllers\Production\PutAwayScanPage;
use App\Http\Controllers\Production\ShowMachine;
use App\Http\Controllers\Production\ViewMachines;
use App\Http\Controllers\Production\ViewProductionRequests;
use App\Http\Controllers\Production\CreateNewMaterialRequestPage;
use App\Http\Controllers\Production\ShowMaterialRequestPage;
use Illuminate\Support\Facades\Route;

Route::get('production/requests', ViewProductionRequests::class)
    ->name('production.requests');

Route::get('machines', ViewMachines::class)
    ->name('machines');

Route::get('machines/{machine:uuid}', ShowMachine::class)
    ->name('machines.show');

Route::middleware('auth')->group(function () {
    Route::get('production/material-request/new', CreateNewMaterialRequestPage::class)
        ->name('production.material-request.new');

    Route::get('production/material-requests/{materialRequest:uuid}', ShowMaterialRequestPage::class)
        ->name('production.material-request.show');

    Route::get('production/put-away/scan', PutAwayScanPage::class)
        ->name('production.put-away.scan');

    Route::get('production/put-away/{materialContainer:uuid}', PutAwayMaterialContainerPage::class)
        ->name('production.put-away.container');
});
