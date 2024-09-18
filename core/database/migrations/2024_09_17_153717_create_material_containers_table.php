<?php

use App\Models\Material;
use App\Models\MaterialContainerType;
use App\Models\MovementStatus;
use App\Models\StorageLocation;
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
        Schema::create('material_containers', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials');
            $table->foreignIdFor(MaterialContainerType::class)->nullable();
            $table->foreignUuid('storage_location_uuid')
                ->references('uuid')
                ->on('storage_locations')
                ->nullable();
            $table->foreignIdFor(MovementStatus::class, 'movement_status_id');
            $table->string('barcode', 100);
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=MaterialContainerSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_containers');
    }
};
