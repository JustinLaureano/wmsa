<?php

namespace App\Domain\Messaging\Actions;

use App\Repositories\ConversationRepository;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class GetConversationMessagesAction
{
    public function handle(string $conversationUuid) : Collection
    {
        (new ConversationRepository)->ensureParticipant(
            conversationUuid: $conversationUuid,
            userUuid: Auth::user()->uuid
        );

        return (new MessageRepository)->getForConversation($conversationUuid);
    }
}
