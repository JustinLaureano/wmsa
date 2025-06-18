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
        Schema::create('irm_chemicals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials');
            $table->integer('lot_quantity')
                ->comment('Base quantity of the standard lot');
            $table->integer('unit_quantity')
                ->comment('Base quantity of each unit in standard lot');
            $table->foreignUuid('assigned_storage_location_uuid')
                ->nullable()
                ->references('uuid')
                ->on('storage_locations');
            $table->foreignUuid('drop_off_storage_location_uuid')
                ->nullable()
                ->references('uuid')
                ->on('storage_locations');
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=IrmChemicalSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irm_chemicals');
    }
};
