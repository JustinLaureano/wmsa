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
            CREATE OR REPLACE VIEW `view_material_routing` AS
                SELECT
                    mr.uuid AS material_routing_uuid,
                    m.uuid AS material_uuid,
                    m.material_number,
                    m.part_number,
                    b.name AS building_name,
                    sla.name AS storage_location_area_name,
                    sequence,
                    is_preferred,
                    fallback_order,
                    mr.building_id,
                    mr.storage_location_area_id,
                    mr.created_at,
                    mr.updated_at,
                    mr.deleted_at
                FROM wms.material_routing mr
                LEFT JOIN materials m
                    ON m.uuid = mr.material_uuid
                LEFT JOIN storage_location_areas sla
                    ON sla.id = mr.storage_location_area_id
                LEFT JOIN buildings b
                    ON b.id = mr.building_id
                ORDER BY m.part_number ASC,
                    mr.building_id ASC,
                    mr.sequence ASC,
                    mr.fallback_order ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_material_routing");
    }
};
