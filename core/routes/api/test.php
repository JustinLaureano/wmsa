<?php

use App\Http\Resources\Auth\UserDetailResource;
use App\Http\Resources\Auth\UserProfileCollection;
use App\Http\Resources\Materials\SafetyStockReportResource;
use App\Models\User;
use App\Repositories\SafetyStockRepository;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return new UserProfileCollection(User::get());
});

Route::get('/user/{cn}', function (string $cn) {
    return new UserDetailResource(User::where('teammate_clock_number', $cn)->first());
});

Route::get('/safety-stock', function () {
    $report = (new SafetyStockRepository())->getSafetyStockReportPaginated();
    // $report = (new SafetyStockRepository())->getSafetyStockReport();
    return SafetyStockReportResource::collection($report);
});