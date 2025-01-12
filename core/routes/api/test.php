<?php

use App\Http\Resources\Auth\UserCollection;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return new UserCollection(User::get());
});

Route::get('/user/{cn}', function (string $cn) {
    return new UserResource(User::where('teammate_clock_number', $cn)->first());
});