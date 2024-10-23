<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\ConversationParticipantData;
use App\Models\ConversationParticipant;

class ConversationParticipantRepository
{
    /**
     * Store a conversation record.
     */
    public function store(ConversationParticipantData $data) : ConversationParticipant
    {
        return ConversationParticipant::query()->create($data->toArray());
    }
}
