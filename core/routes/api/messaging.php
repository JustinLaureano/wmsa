<?php

use App\Http\Controllers\Messaging\AddMessage;
use App\Http\Controllers\Messaging\GetConversationMessages;
use App\Http\Controllers\Messaging\GetConversations;
use App\Http\Controllers\Messaging\MarkMessagesAsRead;
use App\Http\Controllers\Messaging\StartConversation;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/conversations', GetConversations::class)
        ->name('api.conversations');

    Route::get('/conversation/{conversation_uuid}/messages', GetConversationMessages::class)
        ->name('api.conversation.messages');
    
    Route::post('/conversation', StartConversation::class)
        ->name('api.conversation');
    
    Route::post('/messaging/message', AddMessage::class)
        ->name('api.messaging.message');

    Route::post('/messaging/message/read', MarkMessagesAsRead::class)
        ->name('api.messaging.message.read');
});
