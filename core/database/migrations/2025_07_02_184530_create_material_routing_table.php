<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('material_routing', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();

            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials')
                ->comment('Material being routed');

            $table->foreignUuid('material_tote_type_uuid')
                ->nullable()
                ->references('uuid')
                ->on('material_tote_types')
                ->comment('Material tote type being routed in combination with the material');

            $table->foreignId('route_building_id')
                ->references('id')
                ->nullable()
                ->on('buildings')
                ->comment('Specifies the starting building for which this routing rule applies.');

            $table->unsignedInteger('sequence')
                ->comment('Order in the routing sequence (1, 2, 3, etc.)');

            $table->foreignId('storage_location_area_id')
                ->references('id')
                ->on('storage_location_areas')
                ->comment('Target storage location area for this sequence step.');

            $table->boolean('is_preferred')
                ->comment('Indicates if this is the preferred destination for this sequence step.');

            $table->unsignedInteger('fallback_order')
                ->nullable()
                ->comment('Order for fallback locations (1, 2, 3, etc.) if preferred is full');

            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=MaterialRoutingSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_routing');
    }
};
