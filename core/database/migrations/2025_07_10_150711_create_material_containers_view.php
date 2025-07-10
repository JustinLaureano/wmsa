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
            CREATE OR REPLACE VIEW `view_material_containers` AS
                SELECT
                    mc.uuid AS material_container_uuid,
                    m.uuid AS material_uuid,
                    m.part_number,
                    mc.lot_number,
                    mc.quantity,
                    m.base_unit_of_measure,
                    ms.name AS movement_status_name,
                    mct.name AS material_container_type,
                    mtt.tote AS material_tote_type,
                    mc.barcode,
                    mc.expiration_date,
                    mc.material_container_type_id,
                    mc.material_tote_type_uuid,
                    mc.movement_status_code,
                    mc.created_at,
                    mc.updated_at,
                    mc.deleted_at
                FROM wms.material_containers mc
                LEFT JOIN materials m
                    ON m.uuid = mc.material_uuid
                LEFT JOIN material_container_types mct
                    ON mct.id = mc.material_container_type_id
                LEFT JOIN material_tote_types mtt
                    ON mtt.uuid = mc.material_tote_type_uuid
                LEFT JOIN movement_statuses ms
                    ON ms.code = mc.movement_status_code
                ORDER BY part_number ASC,
                    lot_number ASC,
                    quantity DESC,
                    movement_status_code ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_material_containers");
    }
};
