<?php

use App\Http\Controllers\Shipping\ViewShippingRequests;
use Illuminate\Support\Facades\Route;

Route::get('shipping/requests', ViewShippingRequests::class)
    ->name('shipping.requests');

Route::middleware('auth')->group(function () {
    //
});

Route::middleware('auth:teammate')->group(function () {
    //
});
