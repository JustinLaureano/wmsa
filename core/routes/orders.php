<?php

use App\Http\Controllers\Requests\CreateRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->post('request', CreateRequestController::class)
    ->name('request.create');