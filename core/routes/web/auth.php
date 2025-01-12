<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ClockinController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('clockin', [ClockinController::class, 'create'])
    ->name('clockin');

Route::post('clockin', [ClockinController::class, 'store']);


Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::middleware('auth')->group(function () {

    Route::get('/teammates', function () {
            return Inertia::render('Test/Teammates');
        })
        ->name('teammates');

    Route::post('clockout', [ClockinController::class, 'destroy'])
        ->name('clockout');
});
