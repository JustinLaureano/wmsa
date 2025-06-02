<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\ConversationData;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Collection;

class ConversationRepository
{
    public function getForParticipant(string $user_uuid): Collection
    {
        return Conversation::query()
            ->whereParticipant($user_uuid)
            ->with([
                'latestMessage.user.teammate',
                'participants.user.teammate',
            ])
            ->get();
    }

    /**
     * Ensure the given user is a participant in the given conversation.
     */
    public function ensureParticipant(string $conversationUuid, string $userUuid): void
    {
        Conversation::where('uuid', $conversationUuid)
            ->whereParticipant($userUuid)
            ->firstOrFail();
    }

    public function store(ConversationData $data): Conversation
    {
        return Conversation::query()->create($data->toArray());
    }
}
