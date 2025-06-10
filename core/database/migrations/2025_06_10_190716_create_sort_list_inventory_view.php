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
            CREATE OR REPLACE VIEW `view_sort_list_inventory` AS
                SELECT
                    mc.uuid AS material_container_uuid,
                    mc.material_uuid,
                    mc.barcode,
                    mc.lot_number,
                    mc.quantity,
                    m.base_unit_of_measure,
                    mc.expiration_date,
                    m.part_number,
                    ms.name AS movement_status_name,
                    sla.building_id AS storage_location_building_id,
                    sla.name AS storage_location_area_name,
                    sl.name AS storage_location_name
                FROM material_containers mc
                LEFT JOIN materials m
                    ON m.uuid = mc.material_uuid
                LEFT JOIN movement_statuses ms
                    ON ms.code = mc.movement_status_code
                JOIN container_locations cl
                    ON cl.material_container_uuid = mc.uuid
                LEFT JOIN storage_locations sl
                    ON sl.uuid = cl.storage_location_uuid
                LEFT JOIN storage_location_areas sla
                    ON sla.id = sl.storage_location_area_id
                WHERE sl.name IN(
                    'Plant 2 Completion',
                    'Blackhawk Completion',
                    'Plant 2 Sort',
                    'Blackhawk Sort'
                );
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_sort_list_inventory");
    }
};
