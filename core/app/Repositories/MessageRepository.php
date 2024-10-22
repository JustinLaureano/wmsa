<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Models\Message;

class MessageRepository
{
    /**
     * Store a message record.
     */
    public function store(MessageData $data) : Message
    {
        return Message::query()->create($data->toArray());
    }
}
