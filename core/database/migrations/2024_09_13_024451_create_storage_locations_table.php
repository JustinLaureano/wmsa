<?php

use App\Models\StorageLocationArea;
use App\Models\StorageLocationType;
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
        Schema::create('storage_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StorageLocationArea::class);
            $table->foreignIdFor(StorageLocationType::class);
            $table->string('barcode', 40);
            $table->integer('max_containers')->nullable();
            $table->tinyInteger('disabled')->default(0);
            $table->tinyInteger('allocatable')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_locations');
    }
};