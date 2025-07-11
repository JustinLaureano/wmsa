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
            CREATE OR REPLACE VIEW `view_allocated_material_request_items` AS
                SELECT
                    mri.uuid AS material_request_item_uuid,
                    mr.uuid AS material_request_uuid,
                    m.part_number,
                    mri.quantity_requested,
                    mri.quantity_delivered,
                    mri.unit_of_measure,
                    mach.name AS machine_name,
                    sl.name AS storage_location_name,
                    mtt.tote AS material_tote_type,
                    mr.material_request_status_code,
                    mr.material_request_type_code,
                    mri.request_item_status_code,
                    mc.barcode AS container_barcode,
                    mc.lot_number AS container_lot_number,
                    mc.quantity AS container_quantity,
                    mc.movement_status_code AS container_movement_status_code,
                    mc.expiration_date,
                    mct.name AS material_container_type_name,
                    t.clock_number AS requester_clock_number,
                    t.first_name AS requester_first_name,
                    t.last_name AS requester_last_name,
                    mri.material_uuid,
                    mri.machine_uuid,
                    mri.storage_location_uuid,
                    mr.requester_user_uuid,
                    mr.requested_at,
                    mri.created_at,
                    mri.updated_at,
                    mri.deleted_at
                FROM wms.material_request_items mri
                LEFT JOIN material_requests mr
                    ON mr.uuid = mri.material_request_uuid
                JOIN request_container_allocations rcl
                    ON rcl.material_request_item_uuid = mri.uuid
                LEFT JOIN materials m
                    ON m.uuid = mri.material_uuid
                LEFT JOIN material_containers mc
                    ON mc.uuid = rcl.material_container_uuid
                LEFT JOIN material_container_types mct
                    ON mct.id = mc.material_container_type_id
                LEFT JOIN users u
                    ON u.uuid = mr.requester_user_uuid
                LEFT JOIN machines mach
                    ON mach.uuid = mri.machine_uuid
                LEFT JOIN storage_locations sl
                    ON sl.uuid = mri.storage_location_uuid
                LEFT JOIN material_tote_types mtt
                    ON mtt.uuid = mri.material_tote_type_uuid
                LEFT JOIN teammates t
                    ON t.clock_number = u.teammate_clock_number
                WHERE mri.request_item_status_code = 'open'
                    AND mr.material_request_status_code = 'open'
                ORDER BY mri.created_at ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_allocated_material_request_items");
    }
};
