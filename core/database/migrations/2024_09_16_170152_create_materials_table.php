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

            $table->foreignUuid('material_type_code')
                ->nullable()
                ->references('code')
                ->on('material_types');

            $table->decimal('base_quantity')->nullable();

            $table->integer('base_container_unit_quantity')
                ->nullable()
                ->comment('The standard number of units in a container.');

            $table->string('base_unit_of_measure', 4)->default('EA');

            $table->integer('expiration_days')
                ->nullable()
                ->comment('The number of days from manufacture date until the material expires.');

            $table->integer('required_degas_hours')
                ->nullable()
                ->comment('The number of hours required to degas the material.');

            $table->integer('required_hold_hours')
                ->nullable()
                ->comment('The number of hours required to hold the material before it can be used.');

            $table->foreignId('material_container_type_id')
                ->nullable()
                ->references('id')
                ->on('material_container_types')
                ->comment('The standard container type that the material is stored in.');

            $table->boolean('service_part')
                ->default(false)
                ->comment('Designates whether the material is a service part.');

            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=MaterialSeeder');
        // TODO: fix this
        // Artisan::call("scout:import 'App\\Models\\Material'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
