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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->string('material_number', 25)->nullable();
            $table->string('part_number', 25)->nullable();
            $table->string('description', 40)->nullable();
            $table->decimal('base_quantity')->nullable();
            $table->string('base_unit_of_measure', 4)->default('EA');
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=MaterialSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};