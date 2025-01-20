<?php

use App\Http\Controllers\Production\CreateMaterialRequest;
use Illuminate\Support\Facades\Route;

Route::post('/production/material-request', CreateMaterialRequest::class)
    ->name('api.production.material-request');