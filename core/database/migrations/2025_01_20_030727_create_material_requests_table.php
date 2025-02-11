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
            $table->string('material_request_status_code', 12)
                ->references('code')
                ->on('material_request_statuses');
            $table->string('material_request_type_code', 12)
                ->references('code')
                ->on('material_request_types');
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
