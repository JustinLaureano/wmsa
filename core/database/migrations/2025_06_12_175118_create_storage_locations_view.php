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
            CREATE OR REPLACE VIEW `view_storage_locations` AS
                SELECT
                    sl.uuid AS storage_location_uuid,
                    sl.name,
                    sl.barcode,
                    sla.building_id AS building_id,
                    sla.name AS storage_location_area_name,
                    aisle,
                    bay,
                    shelf,
                    position,
                    max_containers,
                    restrict_request_allocations,
                    disabled,
                    reservable,
                    slt.id AS storage_location_type_id,
                    slt.name AS storage_location_type_name,
                    b.name AS building_name,
                    sla.sap_storage_location_group
                FROM wms.storage_locations sl
                LEFT JOIN storage_location_types slt
                    ON slt.id = sl.storage_location_type_id
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
        DB::unprepared("DROP VIEW IF EXISTS view_storage_locations");
    }
};
