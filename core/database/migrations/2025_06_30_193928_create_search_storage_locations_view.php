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
                    sl.name,
                    sl.barcode
                FROM wms.storage_locations sl
                LEFT JOIN storage_location_areas sla
                    ON sla.id = sl.storage_location_area_id
                WHERE sl.deleted_at IS NULL
                ORDER BY name ASC;
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
