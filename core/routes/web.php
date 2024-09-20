<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', function () {
        return redirect()->route('home');
    })
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



require __DIR__.'/domains/auth.php';
require __DIR__.'/domains/irm.php';
require __DIR__.'/domains/materials.php';
require __DIR__.'/domains/production.php';
require __DIR__.'/domains/quality.php';
require __DIR__.'/domains/receiving.php';
require __DIR__.'/domains/shipping.php';

require __DIR__.'/orders.php';
require __DIR__.'/test.php';
