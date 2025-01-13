<?php

use App\Http\Resources\Auth\UserDetailResource;
use App\Http\Resources\Auth\UserProfileCollection;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return new UserProfileCollection(User::get());
});

Route::get('/user/{cn}', function (string $cn) {
    return new UserDetailResource(User::where('teammate_clock_number', $cn)->first());
});