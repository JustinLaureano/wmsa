<?php

use App\Models\Building;
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
        Schema::create('safety_stocks', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials');
            $table->foreignIdFor(Building::class);
            $table->integer('quantity');
            $table->string('unit_of_measure', 4)->default('EA');
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=SafetyStockSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_stocks');
    }
};
