<?php

use App\Http\Controllers\Messaging\AddMessage;
use App\Http\Controllers\Messaging\GetConversations;
use App\Http\Controllers\Messaging\StartConversation;
use Illuminate\Support\Facades\Route;

Route::get('/conversations/{participant_id}/{participant_type}', GetConversations::class)
    ->name('api.conversations');

Route::post('/conversation', StartConversation::class)
    ->name('api.conversation');

Route::post('/messaging/message', AddMessage::class)
    ->name('api.messaging.message');
