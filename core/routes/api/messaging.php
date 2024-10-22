<?php

use App\Http\Controllers\Messaging\AddMessage;
use App\Http\Controllers\Messaging\StartConversation;
use Illuminate\Support\Facades\Route;

Route::post('/conversation', StartConversation::class)
    ->name('api.conversation');

Route::post('/messaging/message', AddMessage::class)
    ->name('api.messaging.message');
