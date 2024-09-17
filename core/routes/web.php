<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SetLocalization;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/teammates', function () {
        return Inertia::render('Test/Teammates');

    })
    ->middleware(['auth:teammate'])
    ->name('teammates');


/**
 *
 * All dev and test above, all real below
 *
 *
 */



Route::get('/', HomeController::class)->name('home');


Route::get('/dashboard', function () {
    return redirect()->route('home');

})
->middleware(['auth', 'verified'])
->name('dashboard');



require __DIR__.'/auth.php';
require __DIR__.'/orders.php';
