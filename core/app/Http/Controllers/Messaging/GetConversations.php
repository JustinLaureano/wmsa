<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\GetConversationsAction;
use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Messaging\ConversationCollection;

class GetConversations extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $user_uuid, GetConversationsAction $action)
    {
        $data = new ParticipantConversationsData(
            user_uuid: $user_uuid
        );

        $conversations = $action->handle($data);

        return new ConversationCollection($conversations, $data);
    }
}
