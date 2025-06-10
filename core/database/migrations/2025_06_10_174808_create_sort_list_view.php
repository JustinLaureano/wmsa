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
            CREATE OR REPLACE VIEW `view_sort_list` AS
                SELECT
                    sl.uuid,
                    slc.uuid AS sort_list_customer_uuid,
                    slc.name AS sort_list_customer_name,
                    m.part_number AS part_number,
                    sl.type,
                    sl.status,
                    sl.reason,
                    sl.percent,
                    sl.standard_time,
                    sl.cert,
                    sl.line_side_sort,
                    sl.list_date,
                    sl.close_date,
                    sl.created_at,
                    sl.updated_at,
                    sl.deleted_at
                FROM wms.sort_list sl
                LEFT JOIN sort_list_customers slc
                    ON slc.uuid = sl.sort_list_customer_uuid
                LEFT JOIN materials m
                    ON m.uuid = sl.material_uuid
                ORDER BY m.part_number ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_sort_list");
    }
};
