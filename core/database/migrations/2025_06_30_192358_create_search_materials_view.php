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
            CREATE OR REPLACE VIEW `view_search_materials` AS
                SELECT
                    m.uuid AS material_uuid,
                    material_number,
                    m.part_number,
                    m.description
                FROM wms.materials m
                WHERE deleted_at IS NULL
                    AND LEFT(part_number, 1) <> 'P'
                ORDER BY part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_search_materials");
    }
};
