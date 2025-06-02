<?php

namespace App\Domain\Messaging\Actions;

use App\Domain\Messaging\DataTransferObjects\ParticipantConversationsData;
use App\Repositories\ConversationRepository;
use Illuminate\Database\Eloquent\Collection;

class GetConversationsAction
{
    public function handle(ParticipantConversationsData $data): Collection
    {
        $conversationRepository = new ConversationRepository;

        $conversations = $conversationRepository
            ->getForParticipant($data->user_uuid)
            ->sortByDesc('latestMessage.created_at');

        return $conversations;
    }
}