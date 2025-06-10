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
            CREATE OR REPLACE VIEW `view_sort_list_part_numbers` AS
                SELECT
                    DISTINCT m.part_number
                FROM sort_list sl
                LEFT JOIN materials m
                    ON m.uuid = sl.material_uuid
                WHERE sl.deleted_at IS NULL
                ORDER BY part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_sort_list_part_numbers");
    }
};
