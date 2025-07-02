<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user')
    ->middleware('auth:sanctum');


Route::post('/localization', [LocalizationController::class, 'set'])->name('localization');

Route::get('/search', [SearchController::class, 'search'])->name('api.search');


require __DIR__.'/api/auth.php';
require __DIR__.'/api/locations.php';
require __DIR__.'/api/materials.php';
require __DIR__.'/api/messaging.php';
require __DIR__.'/api/production.php';
require __DIR__.'/api/test.php';
