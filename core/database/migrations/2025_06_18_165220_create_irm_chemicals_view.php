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
            CREATE OR REPLACE VIEW `view_irm_chemicals` AS
                SELECT
                    ic.id AS barcode_label_id,
                    ic.uuid,
                    m.part_number,
                    ic.lot_quantity,
                    ic.unit_quantity,
                    m.base_unit_of_measure,
                    mct.name AS material_container_type,
                    asl.name AS assigned_storage_location_name,
                    dsl.name AS drop_off_storage_location_name,
                    ic.created_at,
                    ic.updated_at,
                    ic.deleted_at
                FROM irm_chemicals ic
                LEFT JOIN materials m
                    ON m.uuid = ic.material_uuid
                LEFT JOIN material_container_types mct
                    ON mct.id = m.material_container_type_id
                LEFT JOIN storage_locations asl
                    ON asl.uuid = ic.assigned_storage_location_uuid
                LEFT JOIN storage_locations dsl
                    ON dsl.uuid = ic.drop_off_storage_location_uuid
                ORDER BY m.part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_irm_chemicals");
    }
};
