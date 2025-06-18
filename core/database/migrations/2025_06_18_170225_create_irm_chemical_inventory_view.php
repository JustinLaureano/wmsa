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
            CREATE OR REPLACE VIEW `view_irm_chemical_inventory` AS
                SELECT
                    icl.uuid AS irm_chemical_location_uuid,
                    m.part_number,
                    sl.name AS storage_location_name,
                    icl.quantity,
                    m.base_unit_of_measure,
                    mct.name AS material_container_type,
                    icl.created_at,
                    icl.updated_at
                FROM irm_chemical_locations icl
                LEFT JOIN irm_chemicals ic
                    ON ic.uuid = icl.irm_chemical_uuid
                LEFT JOIN materials m
                    ON m.uuid = ic.material_uuid
                LEFT JOIN material_container_types mct
                    ON mct.id = m.material_container_type_id
                LEFT JOIN storage_locations sl
                    ON sl.uuid = icl.storage_location_uuid
                ORDER BY m.part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_irm_chemical_inventory");
    }
};
