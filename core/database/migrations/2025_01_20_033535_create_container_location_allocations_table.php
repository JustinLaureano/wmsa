<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('container_location_allocations', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->foreignUuid('storage_location_uuid')
                ->references('uuid')
                ->on('storage_locations');
            $table->foreignUuid('material_container_uuid')
                ->references('uuid')
                ->on('material_containers');
            $table->timestamp('occurred_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_location_allocations');
    }
};
