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
            CREATE OR REPLACE VIEW `view_container_locations` AS
                SELECT
                    cl.uuid AS container_location_uuid,
                    mc.uuid AS material_container_uuid,
                    mc.material_uuid,
                    m.part_number,
                    mc.lot_number,
                    mc.quantity,
                    mc.expiration_date,
                    mtt.tote,
                    mc.movement_status_code,
                    sl.uuid AS storage_location_uuid,
                    sl.name AS storage_location_name
                FROM container_locations cl
                LEFT JOIN material_containers mc
                    ON mc.uuid = cl.material_container_uuid
                LEFT JOIN materials m
                    ON m.uuid = mc.material_uuid
                LEFT JOIN material_tote_types mtt
                    ON mtt.uuid = mc.material_tote_type_uuid
                LEFT JOIN storage_locations sl
                    ON sl.uuid = cl.storage_location_uuid;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_container_locations");
    }
};
