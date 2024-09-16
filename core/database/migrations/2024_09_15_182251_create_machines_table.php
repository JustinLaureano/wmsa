<?php

use App\Models\Building;
use App\Models\MachineType;
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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->string('name', 40);
            $table->foreignIdFor(Building::class);
            $table->foreignIdFor(MachineType::class);
            // TODO: add active status for machine - whether retired or not, in user or not, etc
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=MachineSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
