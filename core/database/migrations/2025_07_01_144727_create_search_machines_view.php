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
            CREATE OR REPLACE VIEW `view_search_machines` AS
                SELECT
                    m.uuid AS machine_uuid,
                    m.name AS machine_name,
                    b.name AS building_name
                FROM wms.machines m
                LEFT JOIN buildings b
                    ON b.id = m.building_id
                WHERE m.deleted_at IS NULL
                ORDER BY m.name ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_search_machines");
    }
};
