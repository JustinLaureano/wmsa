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
        Schema::create('teammates', function (Blueprint $table) {
            $table->bigInteger('clock_number')->primary();
            $table->string('first_name', 40);
            $table->string('last_name', 40);
            $table->date('hire_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=TeammateSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teammates');
    }
};
