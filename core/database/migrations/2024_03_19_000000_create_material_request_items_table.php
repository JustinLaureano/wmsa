<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('material_request_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignUuid('material_request_uuid')
                ->references('uuid')
                ->on('material_requests');
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials');
            $table->integer('quantity_requested');
            $table->integer('quantity_delivered');
            $table->string('unit_of_measure', 12);
            $table->foreignUuid('machine_uuid')
                ->nullable()
                ->references('uuid')
                ->on('machines');
            $table->foreignUuid('storage_location_uuid')
                ->nullable()
                ->references('uuid')
                ->on('storage_locations');
            $table->foreignUuid('request_item_status_code')
                ->references('code')
                ->on('request_item_statuses')
                ->default('open');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('material_request_items');
    }
};
