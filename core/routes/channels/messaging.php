<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.user.{userUuid}', function ($user, string $userUuid) {
    // TODO: auth correctly
    return true;
}, ['guards' => ['web']]);
