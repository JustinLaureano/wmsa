<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageRepository
{
    /**
     * Get the number of combined unread messages
     * for a user across joint accounts.
     */
    public function getUnreadMessagesCount(
        string $primaryId,
        string $primaryType,
        string $secondaryId,
        string $secondaryType
    ) : int
    {
        $result = DB::select('CALL get_unread_messages_count(?, ?, ?, ?)', [
            $primaryId, 
            $primaryType, 
            $secondaryId, 
            $secondaryType
        ]);

        return $result[0]->unread_messages ?? 0;
    }

    /**
     * Store a message record.
     */
    public function store(MessageData $data) : Message
    {
        return Message::query()->create($data->toArray());
    }
}
