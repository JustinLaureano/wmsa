<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageStatusRepository
{
    /**
     * Get messages for a conversation.
     */
    public function markMessagesAsRead(string $conversationUuid, string $userUuid, Carbon $readAt): void
    {
        DB::statement("
            WITH messages AS (
                SELECT uuid
                FROM messages
                WHERE conversation_uuid = ?
                    AND user_uuid <> ?
            )
            UPDATE message_status s
            JOIN messages m
                ON m.uuid = s.message_uuid
            SET s.is_read = 1, s.read_at = ?
            WHERE s.user_uuid = ?
                AND s.is_read = 0
        ", [$conversationUuid, $userUuid, $readAt, $userUuid]);
    }
}
