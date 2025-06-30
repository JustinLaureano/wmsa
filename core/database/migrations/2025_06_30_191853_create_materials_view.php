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
            CREATE OR REPLACE VIEW `view_materials` AS
                SELECT
                    m.uuid AS material_uuid,
                    material_number,
                    m.part_number,
                    m.description,
                    material_type_code,
                    mt.name AS material_type_name,
                    base_quantity,
                    base_container_unit_quantity,
                    base_unit_of_measure,
                    expiration_days,
                    required_degas_hours,
                    required_hold_hours,
                    mct.name AS material_container_type_name,
                    service_part,
                    m.created_at,
                    m.updated_at,
                    m.deleted_at
                FROM wms.materials m
                LEFT JOIN material_types mt
                    ON mt.code = m.material_type_code
                LEFT JOIN material_container_types mct
                    ON mct.id = m.material_container_type_id
                ORDER BY part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_materials");
    }
};
