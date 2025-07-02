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
            CREATE OR REPLACE VIEW `view_search_storage_locations` AS
                SELECT
                    sl.uuid AS storage_location_uuid,
                    sl.name AS storage_location_name,
                    b.name AS building_name
                FROM wms.storage_locations sl
                LEFT JOIN storage_location_areas sla
                    ON sla.id = sl.storage_location_area_id
                LEFT JOIN buildings b
                    ON b.id = sla.building_id
                WHERE sl.deleted_at IS NULL
                ORDER BY sl.name ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_search_storage_locations");
    }
};
