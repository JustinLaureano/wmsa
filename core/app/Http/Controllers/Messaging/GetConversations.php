<?php

namespace App\Http\Controllers\Messaging;

use App\Domain\Messaging\Actions\GetConversationsAction;
use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Http\Controllers\Controller;
use App\Http\Resources\Messaging\ConversationCollection;
use Illuminate\Http\Request;

class GetConversations extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, GetConversationsAction $action)
    {
        $user = $request->user();
        $data = new ParticipantConversationsData(
            user_uuid: $user->uuid
        );

        $conversations = $action->handle($data);


        logger()->info('Conversations', ['conversations' => $conversations]);

        return new ConversationCollection($conversations, $data);
    }
}
