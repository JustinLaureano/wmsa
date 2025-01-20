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
        Schema::create('material_request_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->index();
            $table->string('name', 12);
            $table->string('description', 30);
        });

        Artisan::call('db:seed --class=MaterialRequestStatusSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_request_statuses');
    }
};
