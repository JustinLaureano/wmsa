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
        Schema::create('material_container_movements', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();

            $table->foreignUuid('material_container_uuid')
                ->references('uuid')
                ->on('material_containers')
                ->comment('Material container being moved');

            $table->foreignId('route_building_id')
                ->references('id')
                ->on('buildings')
                ->comment('Specifies the starting building for which this movement applies.');

            $table->unsignedInteger('sequence')
                ->nullable()
                ->comment('The sequence number from material_routing');

            $table->foreignUuid('storage_location_uuid')
                ->references('uuid')
                ->on('storage_locations')
                ->comment('Storage location being moved to');

            $table->boolean('is_sort_location')
                ->comment('Indicates if this movement was to a sort location');

            $table->timestamp('moved_at')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_container_movements');
    }
};
