<?php

use App\Http\Controllers\Quality\ViewSortList;
use Illuminate\Support\Facades\Route;

Route::get('quality/sort', ViewSortList::class)
    ->name('quality.sort');

Route::middleware('auth')->group(function () {
    //
});
