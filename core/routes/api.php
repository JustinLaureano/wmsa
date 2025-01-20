<?php

use App\Http\Controllers\LocalizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user')
    ->middleware('auth:sanctum');


Route::post('/localization', [LocalizationController::class, 'set'])->name('localization');


require __DIR__.'/api/materials.php';
require __DIR__.'/api/messaging.php';
require __DIR__.'/api/production.php';
require __DIR__.'/api/test.php';
