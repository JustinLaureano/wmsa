<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Materials\ViewMaterials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user')
    ->middleware('auth:sanctum');


Route::post('/localization', [LocalizationController::class, 'set'])->name('localization');


/**
 * Materials
 */

Route::get('/materials', ViewMaterials::class)
    ->name('api.materials');
