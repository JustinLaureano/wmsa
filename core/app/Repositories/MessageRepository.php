<?php

namespace App\Repositories;

use App\Domain\Messaging\DataTransferObjects\MessageData;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class MessageRepository
{
    /**
     * Get messages for a conversation.
     */
    public function getForConversation(string $conversationUuid): Collection
    {
        return Message::query()
            ->where('conversation_uuid', $conversationUuid)
            ->with(['user.teammate', 'status'])
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get()
            ->reverse();
    }

    /**
     * Get the number of unread messages for a user.
     */
    public function getUnreadMessagesCount(string $userUuid): int
    {
        $result = DB::select('CALL get_unread_messages_count(?)', [$userUuid]);

        return $result[0]->unread_messages ?? 0;
    }

    /**
     * Get the number of unread messages in a conversation.
     */
    public function getUnreadConversationMessagesCount(string $conversationUuid, string $userUuid): int
    {
        $result = DB::select('CALL get_unread_conversation_messages_count(?, ?)', [
            $conversationUuid,
            $userUuid
        ]);

        return $result[0]->unread_messages ?? 0;
    }

    /**
     * Store a message record.
     */
    public function store(MessageData $data): Message
    {
        return Message::query()->create($data->toArray());
    }
}
