<?php

use App\Http\Controllers\Messaging\AddMessage;
use Illuminate\Support\Facades\Route;

Route::post('/messaging/message', AddMessage::class)
    ->name('api.messaging.message');
