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
        Schema::create('storage_location_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->string('description', 100)->nullable();
            $table->integer('default_max_containers')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=StorageLocationTypeSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_location_types');
    }
};
