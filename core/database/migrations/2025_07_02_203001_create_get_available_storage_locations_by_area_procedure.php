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
            CREATE PROCEDURE get_available_storage_locations_by_area(
                IN p_storage_location_area_id INT,
                IN p_limit INT
            )
            BEGIN
                -- Set a default large limit if p_limit is NULL or <= 0
                SET @limit_value = IF(p_limit IS NULL OR p_limit <= 0, 10000, p_limit);

                -- Use a prepared statement to apply the LIMIT dynamically
                SET @sql = CONCAT('
                    SELECT sl.*
                    FROM storage_locations sl
                    LEFT JOIN (
                        SELECT storage_location_uuid, COUNT(*) as container_count
                        FROM container_locations
                        GROUP BY storage_location_uuid
                    ) cl ON cl.storage_location_uuid = sl.uuid
                    WHERE sl.storage_location_area_id = ', p_storage_location_area_id, '
                    AND sl.disabled = 0
                    AND sl.reservable = 1
                    AND (
                        sl.max_containers IS NULL
                        OR COALESCE(cl.container_count, 0) < sl.max_containers
                    )
                    LIMIT ', @limit_value);

                PREPARE stmt FROM @sql;
                EXECUTE stmt;
                DEALLOCATE PREPARE stmt;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS get_available_storage_locations_by_area");
    }
};
