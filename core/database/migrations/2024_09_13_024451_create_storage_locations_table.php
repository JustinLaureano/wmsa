<?php

use App\Models\StorageLocationArea;
use App\Models\StorageLocationType;
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
        Schema::create('storage_locations', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->string('name', 30);
            $table->string('barcode', 40);
            $table->foreignIdFor(StorageLocationType::class);
            $table->foreignIdFor(StorageLocationArea::class);
            $table->integer('aisle')->nullable();
            $table->integer('bay')->nullable();
            $table->integer('shelf')->nullable();
            $table->integer('position')->nullable();
            $table->integer('max_containers')->nullable();
            $table->tinyInteger('restrict_request_allocations')->default(0);
            $table->tinyInteger('disabled')->default(0);
            $table->tinyInteger('reservable')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=StorageLocationSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_locations');
    }
};
