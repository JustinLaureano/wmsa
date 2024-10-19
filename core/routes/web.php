<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', function () {
        return redirect()->route('home');
    })
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



require __DIR__.'/web/auth.php';
require __DIR__.'/web/irm.php';
require __DIR__.'/web/locations.php';
require __DIR__.'/web/materials.php';
require __DIR__.'/web/production.php';
require __DIR__.'/web/quality.php';
require __DIR__.'/web/receiving.php';
require __DIR__.'/web/shipping.php';

require __DIR__.'/orders.php';
require __DIR__.'/test.php';
