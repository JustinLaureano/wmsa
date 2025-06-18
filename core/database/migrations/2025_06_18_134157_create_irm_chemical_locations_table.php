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
        Schema::create('irm_chemical_locations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->foreignUuid('irm_chemical_uuid')
                ->references('uuid')
                ->on('irm_chemicals');
            $table->foreignUuid('storage_location_uuid')
                ->references('uuid')
                ->on('storage_locations');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irm_chemical_locations');
    }
};
