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
        Schema::create('cardboard_materials', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->string('part_number', 8);
            $table->string('display_part_number', 60);
            $table->string('customer_part_number', 16)->nullable();
            $table->string('description')->nullable();
            $table->integer('quantity')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=CardboardMaterialSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardboard_materials');
    }
};
