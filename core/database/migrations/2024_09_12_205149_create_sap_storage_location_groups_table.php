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
        Schema::create('sap_storage_location_groups', function (Blueprint $table) {
            $table->id();
            $table->string('system', 6);
            $table->string('location_group', 4);
            $table->string('category', 20);
        });

        Artisan::call('db:seed --class=SapStorageLocationGroupSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sap_storage_location_groups');
    }
};
