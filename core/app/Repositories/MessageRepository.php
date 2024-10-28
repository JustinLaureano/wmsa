<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MessageRepository
{
    public function getForConversation(string $conversationUuid) : Collection
    {
        return Message::query()
            ->where('conversation_uuid', $conversationUuid)
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get()
            ->reverse();
    }

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
     * Get the number of combined unread messages
     * for a user across joint accounts for a 
     * single conversation.
     */
    public function getUnreadConversationMessagesCount(
        string $conversationUuid,
        string $primaryId,
        string $primaryType,
        string $secondaryId,
        string $secondaryType
    ) : int
    {
        $result = DB::select('CALL get_unread_conversation_messages_count(?, ?, ?, ?, ?)', [
            $conversationUuid,
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
