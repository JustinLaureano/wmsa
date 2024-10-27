<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{participantType}.{participantId}', function ($user, string $participantType, string $participantId) {
    \Illuminate\Support\Facades\Log::debug('auth: '. $user);
    \Illuminate\Support\Facades\Log::debug('id: '. $participantId .' type: '. $participantType);
    \Illuminate\Support\Facades\Log::debug(' --------- ');
    // TODO: auth correctly
    return true;
}, ['guards' => ['web', 'teammate']]);
