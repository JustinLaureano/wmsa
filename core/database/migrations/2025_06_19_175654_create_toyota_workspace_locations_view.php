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
            CREATE OR REPLACE VIEW `view_toyota_workspace_locations` AS
                SELECT
                    twl.uuid AS toyota_workspace_location_uuid,
                    m.part_number,
                    sl.name AS storage_location_name,
                    twl.material_uuid,
                    twl.storage_location_uuid,
                    twl.created_at,
                    twl.updated_at,
                    twl.deleted_at
                FROM toyota_workspace_locations twl
                LEFT JOIN materials m
                    ON m.uuid = twl.material_uuid
                LEFT JOIN storage_locations sl
                    ON sl.uuid = twl.storage_location_uuid
                ORDER BY m.part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_toyota_workspace_locations");
    }
};
