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
            CREATE OR REPLACE VIEW `view_search_irm_chemicals` AS
                SELECT
                    ic.uuid AS irm_chemical_uuid,
                    m.material_number,
                    m.part_number,
                    m.description
                FROM wms.irm_chemicals ic
                LEFT JOIN materials m
                    ON m.uuid = ic.material_uuid
                WHERE ic.deleted_at IS NULL
                ORDER BY part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_search_irm_chemicals");
    }
};
