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
        Schema::create('conversation_participants', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('conversation_uuid')
                ->references('uuid')
                ->on('conversations');
            $table->string('participant_id', 40); // TODO: index?
            $table->enum('participant_type', ['user', 'teammate']);
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=ConversationSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_participants');
    }
};
