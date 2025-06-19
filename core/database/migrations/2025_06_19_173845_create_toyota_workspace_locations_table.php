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
        Schema::create('toyota_workspace_locations', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials')
                ->comment('The assigned material that is designated to this workspace location.');
            $table->foreignUuid('storage_location_uuid')
                ->references('uuid')
                ->on('storage_locations')
                ->comment('The storage location that is designated as a Toyota shipping workspace.');
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=ToyotaWorkspaceLocationSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toyota_workspace_locations');
    }
};
