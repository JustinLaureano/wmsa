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
            CREATE OR REPLACE VIEW `view_machines` AS
                SELECT
                    m.uuid,
                    m.name AS machine_name,
                    m.barcode,
                    b.name AS building_name,
                    b.location AS building_location,
                    mt.name AS machine_type_name,
                    m.created_at,
                    m.updated_at,
                    m.deleted_at
                FROM wms.machines m
                LEFT JOIN buildings b
                    ON b.id = m.building_id
                LEFT JOIN machine_types mt
                    ON mt.id = mt.id
                ORDER BY m.name ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_machines");
    }
};
