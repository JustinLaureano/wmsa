<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS get_unread_messages_count;
            CREATE PROCEDURE get_unread_messages_count(
                IN userUuid VARCHAR(40)
            )
            BEGIN
                WITH conversations AS (
                    SELECT
                        distinct(c.uuid)
                    FROM conversations c
                    INNER JOIN conversation_participants p
                        ON p.conversation_uuid = c.uuid
                    WHERE p.user_uuid = userUuid
                )
                SELECT
                    COUNT(m.uuid) AS unread_messages
                FROM messages m
                LEFT JOIN message_status ms
                    ON ms.message_uuid = m.uuid
                WHERE m.conversation_uuid IN (SELECT uuid FROM conversations)
                    AND ms.uuid IS NULL
                    AND m.user_uuid = userUuid;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS get_unread_messages_count");
    }
};
