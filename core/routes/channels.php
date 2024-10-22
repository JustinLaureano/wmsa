<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('messages.{participantId}', function ($user, $participantId) {
    \Illuminate\Support\Facades\Log::debug('auth: '. $user .' id: '. $participantId);
    // TODO: auth correctly
    return true;
});
