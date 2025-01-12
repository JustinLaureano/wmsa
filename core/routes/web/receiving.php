<?php

use App\Http\Controllers\Receiving\ViewPurchasingDocuments;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('receiving/documents', ViewPurchasingDocuments::class)
        ->name('receiving.documents');
});
