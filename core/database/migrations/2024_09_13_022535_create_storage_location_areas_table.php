<?php

use App\Models\Building;
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
        Schema::create('storage_location_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Building::class);
            $table->string('name', 20);
            $table->string('description', 50);
            $table->string('sap_storage_location_group', 4);
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=StorageLocationAreaSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_location_areas');
    }
};
