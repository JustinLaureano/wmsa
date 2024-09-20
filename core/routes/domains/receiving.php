<?php

use App\Http\Controllers\Receiving\ViewPurchasingDocuments;
use Illuminate\Support\Facades\Route;

Route::get('receiving/documents', ViewPurchasingDocuments::class)
    ->name('receiving.documents');

Route::middleware('auth')->group(function () {
    //
});

Route::middleware('auth:teammate')->group(function () {
    //
});
