<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{participantType}.{participantId}', function ($user, string $participantType, string $participantId) {
    // TODO: auth correctly
    return true;
}, ['guards' => ['web']]);
