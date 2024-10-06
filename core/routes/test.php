<?php

use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Models\MaterialContainer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/barcode', function () {
    $con = MaterialContainer::inRandomOrder()->first();
    $barcode = BarcodeFactory::make($con->barcode);

    return response()->json([
        'string' => $con->barcode,
        'barcode' => $barcode->toArray()
    ]);
});

Route::get('/barcode/create', function () {
    $con = MaterialContainer::factory()->create();

    return response()->json($con);
});





/**
 * testing front end tables
 */


Route::get('/table/test', function () {
        $containers = MaterialContainer::query()->filter()->paginate(5);

        return \Inertia\Inertia::render('Test/Tables', [
            'containers' => $containers
        ]);
    })
    ->name('table.test');



Route::get('/container/test', function () {
        return \Inertia\Inertia::render('Test/Containers');
    })
    ->name('container.test');
