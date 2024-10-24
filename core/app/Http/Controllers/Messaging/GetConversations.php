<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\GetConversationsAction;
use App\Domain\Messaging\DataTransferObjects\GetConversationsData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Messaging\ConversationResource;

class GetConversations extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $participant_id, string $participant_type, GetConversationsAction $action)
    {
        $data = new GetConversationsData(
            participant_id: $participant_id,
            participant_type: $participant_type
        );

        $conversations = $action->handle($data);

        return ConversationResource::collection($conversations);
    }
}
