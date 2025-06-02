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
     * Get the total number of unread messages for a user across all their conversations.
     *
     * @param string $userUuid
     * @return int
     */
    public function getTotalUnreadMessagesCount(string $userUuid): int
    {
        return Message::query()
            ->whereIn('conversation_uuid', function ($query) use ($userUuid) {
                $query->select('conversation_uuid')
                      ->from('conversation_participants')
                      ->where('user_uuid', $userUuid);
            })
            ->where('user_uuid', '!=', $userUuid) // Exclude messages sent by the user
            ->whereNotExists(function ($query) use ($userUuid) {
                $query->select(DB::raw(1))
                      ->from('message_status')
                      ->whereColumn('message_status.message_uuid', 'messages.uuid')
                      ->where('message_status.user_uuid', $userUuid)
                      ->where('is_read', true);
            })
            ->count();
    }

    /**
     * Get the number of unread messages for a specific conversation for a user.
     *
     * @param string $conversationUuid
     * @param string $userUuid
     * @return int
     */
    public function getConversationUnreadMessagesCount(string $conversationUuid, string $userUuid): int
    {
        return Message::query()
            ->where('conversation_uuid', $conversationUuid)
            ->whereIn('conversation_uuid', function ($query) use ($userUuid) {
                $query->select('conversation_uuid')
                      ->from('conversation_participants')
                      ->where('user_uuid', $userUuid);
            })
            ->where('user_uuid', '!=', $userUuid) // Exclude messages sent by the user
            ->whereNotExists(function ($query) use ($userUuid) {
                $query->select(DB::raw(1))
                      ->from('message_status')
                      ->whereColumn('message_status.message_uuid', 'messages.uuid')
                      ->where('message_status.user_uuid', $userUuid)
                      ->where('is_read', true);
            })
            ->count();
    }

    /**
     * Store a message record.
     */
    public function store(MessageData $data): Message
    {
        return Message::query()->create($data->toArray());
    }
}
