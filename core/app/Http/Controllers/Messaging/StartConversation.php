<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\StartConversationAction;
use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Domain\Messaging\DataTransferObjects\StartConversationRequestData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Messaging\ConversationResource;

class StartConversation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StartConversationRequestData $data, StartConversationAction $action)
    {
        $conversation = $action->handle($data);

        return (new ConversationResource($conversation))->setParticipantData(
            new ParticipantConversationsData(
                user_uuid: $data->user_uuid
            )
        );
    }
}