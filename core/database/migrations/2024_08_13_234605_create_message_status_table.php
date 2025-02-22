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
        Schema::create('message_status', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('message_uuid')
                ->references('uuid')
                ->on('messages');
            $table->string('participant_id', 40); // TODO: index?
            $table->enum('participant_type', ['user', 'teammate']);
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_status');
    }
};
