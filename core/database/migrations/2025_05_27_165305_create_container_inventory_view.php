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
            CREATE OR REPLACE VIEW `view_container_inventory` AS
                SELECT
                    mc.id,
                    mc.uuid,
                    mc.material_uuid,
                    mc.barcode,
                    mc.lot_number,
                    mc.quantity,
                    mc.expiration_date,
                    m.material_number,
                    m.part_number,
                    m.description AS material_description,
                    m.base_unit_of_measure,
                    mct.name AS container_type_name,
                    ms.name AS movement_status_name,
                    sl.name AS storage_location_name
                FROM material_containers mc
                LEFT JOIN materials m
                    ON m.uuid = mc.material_uuid
                LEFT JOIN material_container_types mct
                    ON mct.id = mc.material_container_type_id
                LEFT JOIN movement_statuses ms
                    ON ms.code = mc.movement_status_code
                JOIN container_locations cl
                    ON cl.material_container_uuid = mc.uuid
                LEFT JOIN storage_locations sl
                    ON sl.uuid = cl.storage_location_uuid;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_container_inventory");
    }
};
