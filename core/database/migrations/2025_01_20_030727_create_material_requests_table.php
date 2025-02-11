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
        Schema::create('material_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials');
            $table->integer('quantity');
            $table->string('unit_of_measure', 12);
            $table->foreignUuid('machine_uuid')
                ->nullable()
                ->references('uuid')
                ->on('machines');
            $table->foreignUuid('storage_location_uuid')
                ->nullable()
                ->references('uuid')
                ->on('storage_locations');
            $table->foreignUuid('material_request_status_code')
                ->references('code')
                ->on('material_request_statuses');
            $table->foreignUuid('requester_user_uuid')
                ->nullable()
                ->references('uuid')
                ->on('users');
            $table->timestamp('requested_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_requests');
    }
};
