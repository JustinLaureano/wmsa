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
        Schema::create('conversation_group_participants', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('conversation_group_uuid')
                ->references('uuid')
                ->on('conversation_groups');
            $table->string('participant_id', 40); // TODO: index?
            $table->enum('participant_type', ['user', 'teammate']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_group_participants');
    }
};
