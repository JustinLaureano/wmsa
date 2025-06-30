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
            CREATE OR REPLACE VIEW `view_search_material_containers` AS
                SELECT
                    mc.uuid AS material_container_uuid,
                    m.material_number,
                    m.part_number,
                    mc.barcode,
                    mc.lot_number,
                    mc.quantity,
                    sl.name AS storage_location_name,
                    sla.name AS storage_location_area_name
                FROM wms.material_containers mc
                LEFT JOIN materials m	
                    ON m.uuid = mc.material_uuid
                LEFT JOIN container_locations cl
                    ON cl.material_container_uuid = mc.uuid
                LEFT JOIN storage_locations sl
                    ON sl.uuid = cl.storage_location_uuid
                LEFT JOIN storage_location_areas sla
                    ON sla.id = sl.storage_location_area_id
                WHERE mc.deleted_at IS NULL
                ORDER BY m.part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_search_material_containers");
    }
};
