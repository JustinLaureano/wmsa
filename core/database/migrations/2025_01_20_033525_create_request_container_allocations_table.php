<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_container_allocations', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('material_request_item_uuid')
                ->references('uuid')
                ->on('material_request_items');
            $table->foreignUuid('material_container_uuid')
                ->references('uuid')
                ->on('material_containers');
            $table->boolean('in_transit')->default(false);
            $table->foreignUuid('transit_user_uuid')
                ->references('uuid')
                ->on('users')
                ->nullable();
            $table->boolean('is_reserved')->default(false); 
            $table->timestamp('occurred_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_container_allocations');
    }
};
