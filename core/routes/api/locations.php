<?php

use App\Http\Controllers\Locations\GetLocationInformation;
use Illuminate\Support\Facades\Route;

Route::get('/locations/barcode/{barcode}', GetLocationInformation::class)
    ->name('api.location.information');
