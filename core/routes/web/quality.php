<?php

use App\Http\Controllers\Quality\ShowSortListPart;
use App\Http\Controllers\Quality\ViewSortList;
use App\Http\Controllers\Quality\ViewSortListPartNumbers;
use App\Http\Controllers\Quality\ViewSortInventory;
use Illuminate\Support\Facades\Route;

Route::get('quality/sort', ViewSortList::class)
    ->name('quality.sort');

Route::get('quality/sort/part-numbers', ViewSortListPartNumbers::class)
    ->name('quality.sort.part-numbers');

Route::middleware('auth')->group(function () {
    Route::get('quality/sort/inventory', ViewSortInventory::class)
        ->name('quality.sort.inventory');

    Route::get('quality/sort/{sortList:uuid}', ShowSortListPart::class)
        ->name('quality.sort.show');
});
