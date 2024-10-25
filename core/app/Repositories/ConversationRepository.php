<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\ConversationData;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Collection;

class ConversationRepository
{
    /**
     * Store a conversation record.
     */
    public function getForParticipant(string $participant_id, string $participant_type) : Collection
    {
        return Conversation::query()
            ->whereParticipant($participant_id, $participant_type)
            ->with([
                'latestMessage' => [
                    'sender',
                    'status'
                ],
                'participants.participant'
            ])
            ->get();
    }

    /**
     * Store a conversation record.
     */
    public function store(ConversationData $data) : Conversation
    {
        return Conversation::query()->create($data->toArray());
    }
}
