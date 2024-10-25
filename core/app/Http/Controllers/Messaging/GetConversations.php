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
    public function __invoke(string $participant_id, string $participant_type, GetConversationsAction $action)
    {
        $data = new ParticipantConversationsData(
            participant_id: $participant_id,
            participant_type: $participant_type
        );

        $conversations = $action->handle($data);

        return new ConversationCollection($conversations, $data);
    }
}
