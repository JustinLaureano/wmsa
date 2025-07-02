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
        Schema::create('sort_storage_locations', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();

            // Needed?
            $table->foreignId('building_id')
                ->references('id')
                ->on('buildings')
                ->cascadeOnDelete()
                ->comment('Building this sort location is located in.');

            $table->foreignId('storage_location_area_id')
                ->references('id')
                ->on('storage_location_areas')
                ->cascadeOnDelete()
                ->comment('Storage location area for this sort location.');

            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=SortStorageLocationSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sort_storage_locations');
    }
};
