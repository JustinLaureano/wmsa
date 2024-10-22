<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\ConversationData;
use App\Models\Conversation;

class ConversationRepository
{
    /**
     * Store a conversation record.
     */
    public function store(ConversationData $data) : Conversation
    {
        return Conversation::query()->create($data->toArray());
    }
}
