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
        /**
         * This is for conversations between members of the 
         * group only with no other outside participants.
         */
        Schema::create('group_conversations', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('conversation_group_uuid')
                ->references('uuid')
                ->on('conversation_groups');
            $table->foreignUuid('conversation_uuid')
                ->references('uuid')
                ->on('conversations');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_conversations');
    }
};
