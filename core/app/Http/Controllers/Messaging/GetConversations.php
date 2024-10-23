<?php

namespace App\Http\Controllers\Messaging;

use App\Http\Controllers\Controller;

class GetConversations extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $participantId, string $participantType)
    {
        // TODO: get conversations for participant
        return response()
            ->json([
                'id' => $participantId,
                'type' => $participantType,
            ]);
    }
}
