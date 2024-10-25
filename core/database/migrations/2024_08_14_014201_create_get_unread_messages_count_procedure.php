<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
                IN primaryId VARCHAR(40),
                IN primaryType ENUM('user','teammate'),
                IN secondaryId VARCHAR(40),
                IN secondaryType ENUM('user','teammate')
            )
            BEGIN
                WITH conversations AS (
                    SELECT
                        distinct(c.uuid)
                    FROM conversations c
                    INNER JOIN conversation_participants p
                        ON p.conversation_uuid = c.uuid
                    WHERE (
                        (p.participant_id = primaryId COLLATE utf8mb4_unicode_ci AND p.participant_type = primaryType COLLATE utf8mb4_unicode_ci)
                        OR
                        (p.participant_id = secondaryId COLLATE utf8mb4_unicode_ci AND p.participant_type = secondaryType COLLATE utf8mb4_unicode_ci)
                    )
                )
                SELECT
                    COUNT(m.uuid) AS unread_messages
                FROM messages m
                LEFT JOIN message_status ms
                    ON ms.message_uuid = m.uuid
                WHERE m.conversation_uuid IN (SELECT uuid FROM conversations)
                    AND ms.uuid IS NULL
                    AND ( 
                        (m.sender_id <> primaryId COLLATE utf8mb4_unicode_ci AND m.sender_type = primaryType COLLATE utf8mb4_unicode_ci)
                        OR
                        (m.sender_id <> secondaryId COLLATE utf8mb4_unicode_ci AND m.sender_type = secondaryType COLLATE utf8mb4_unicode_ci)
                    );
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
