<?php

namespace App\Domain\Messaging\Actions;

use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Database\Eloquent\Collection;

class GetConversationMessagesAction
{
    public function handle(string $conversationUuid) : Collection
    {
        return (new MessageRepository)->getForConversation($conversationUuid);
    }
}
