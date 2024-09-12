<?php

use App\Models\BuildingType;
use App\Models\Organization;
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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class);
            $table->string('name', 50);
            $table->string('location', 100);
            $table->foreignIdFor(BuildingType::class);
            $table->timestamps();
            $table->softDeletes();

            Artisan::call('db:seed --class=BuildingSeeder');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
