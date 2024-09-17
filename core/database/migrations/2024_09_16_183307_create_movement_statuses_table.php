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
        Schema::create('movement_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->string('description', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=MovementStatusSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movement_statuses');
    }
};
