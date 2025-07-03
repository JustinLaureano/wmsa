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
        Schema::create('building_transfer_areas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('building_id')
                ->references('id')
                ->on('buildings')
                ->cascadeOnDelete()
                ->comment('Building this transfer area is located in.');

            $table->unsignedBigInteger('inbound_storage_location_area_id')
                ->comment('Storage location area for inbound material.');

            $table->foreign(
                    'inbound_storage_location_area_id',
                    'building_transfer_areas_inbound_area_id_foreign'
                )
                ->references('id')
                ->on('storage_location_areas')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('outbound_storage_location_area_id')
                ->comment('Storage location area for outbound material.');

            $table->foreign(
                    'outbound_storage_location_area_id',
                    'building_transfer_areas_outbound_area_id_foreign'
                )
                ->references('id')
                ->on('storage_location_areas')
                ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=BuildingTransferAreaSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_transfer_areas');
    }
};
