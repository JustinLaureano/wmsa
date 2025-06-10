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
        Schema::create('container_events', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('material_container_uuid')
                ->references('uuid')
                ->on('material_containers');
            $table->string('event_type', 40);
            $table->json('event_data');
            $table->text('summary')->nullable();
            $table->timestamp('occurred_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_events');
    }
};
