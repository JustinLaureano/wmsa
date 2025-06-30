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
            CREATE OR REPLACE VIEW `view_users` AS
                SELECT
                    u.uuid AS user_uuid,
                    t.clock_number,
                    t.first_name,
                    t.last_name,
                    da.display_name,
                    da.username,
                    da.title,
                    da.description,
                    da.department,
                    da.email,
                    t.hire_date,
                    da.guid AS domain_account_guid,
                    u.created_at,
                    u.updated_at,
                    u.deleted_at
                FROM users u
                LEFT JOIN teammates t
                    ON t.clock_number = u.teammate_clock_number
                LEFT JOIN domain_accounts da
                    ON da.guid = u.domain_account_guid
                ORDER BY teammate_clock_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_users");
    }
};
