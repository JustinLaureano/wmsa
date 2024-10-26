<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\GetConversationMessagesAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Messaging\MessageCollection;

class GetConversationMessages extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $conversation_uuid, GetConversationMessagesAction $action)
    {
        $messages = $action->handle($conversation_uuid);

        return new MessageCollection($messages);
    }
}
