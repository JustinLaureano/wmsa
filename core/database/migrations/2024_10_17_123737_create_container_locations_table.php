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
        Schema::create('container_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('material_container_uuid')
                ->references('uuid')
                ->on('material_containers');
            $table->foreignUuid('storage_location_uuid')
                ->references('uuid')
                ->on('storage_locations')
                ->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed --class=ContainerLocationSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_locations');
    }
};
