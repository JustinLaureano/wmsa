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
            CREATE OR REPLACE VIEW `view_search_sort_list` AS
                SELECT
                    sl.uuid AS sort_list_uuid,
                    m.part_number,
                    m.description AS material_description,
                    sl.status
                FROM wms.sort_list sl
                LEFT JOIN materials m
                    ON m.uuid = sl.material_uuid
                WHERE sl.deleted_at IS NULL
                ORDER BY m.part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_search_sort_list");
    }
};
