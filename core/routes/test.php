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
        Log::debug('here');
        foreach (request()->query() as $field => $value) {
            Log::debug('field: '. $field .' | value: '. $value);
        }

        $containers = MaterialContainer::query()->paginate(5);

        return \Inertia\Inertia::render('Test/Tables', [
            'containers' => $containers
        ]);
    })
    ->name('table.test');