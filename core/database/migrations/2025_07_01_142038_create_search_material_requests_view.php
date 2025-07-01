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
            CREATE OR REPLACE VIEW `view_search_material_requests` AS
                SELECT
                    mr.uuid AS material_request_uuid,
                    mat.material_number,
                    mat.part_number,
                    mat.description AS material_description,
                    mach.name AS machine_name,
                    sl.name AS storage_location_name,
                    mr.material_request_status_code,
                    mr.material_request_type_code
                FROM wms.material_request_items mri
                LEFT JOIN material_requests mr
                    ON mr.uuid = mri.material_request_uuid
                LEFT JOIN materials mat
                    ON mat.uuid = mri.material_uuid
                LEFT JOIN machines mach
                    ON mach.uuid = mri.machine_uuid
                LEFT JOIN storage_locations sl
                    ON sl.uuid = mri.storage_location_uuid
                WHERE mri.deleted_at IS NULL
                    AND mr.deleted_at IS NULL
                    AND (
                        mr.material_request_status_code = 'open' OR
                        mr.updated_at >= NOW() - INTERVAL 24 HOUR
                    )
                ORDER BY mr.created_at DESC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_search_material_requests");
    }
};
