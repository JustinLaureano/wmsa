<?php

use App\Http\Controllers\Auth\SetSessionBuildingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/auth/building', SetSessionBuildingController::class)
        ->name('api.auth.building');
});
