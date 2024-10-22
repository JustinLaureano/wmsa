<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\ConversationData;
use App\Domain\Messaging\DataTransferObjects\StartConversationRequestData;
use App\Models\Conversation;
use App\Repositories\ConversationRepository;
use Illuminate\Support\Str;

class StartConversationAction
{
    public function handle(StartConversationRequestData $data) : Conversation
    {
        $conversation = (new ConversationRepository)
            ->store(new ConversationData(
                uuid: Str::uuid(),
                group_conversation: $data->group_conversation
            ));

        // TODO: add message for conversation

        // TODO: dispatch message sent

        return $conversation;
    }
}
