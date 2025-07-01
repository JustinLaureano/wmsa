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
                    uuid AS machine_uuid,
                    name AS machine_name
                FROM wms.machines
                WHERE deleted_at IS NULL
                ORDER BY name ASC;
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
