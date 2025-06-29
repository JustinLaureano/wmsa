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
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('user_uuid')
                ->references('uuid')
                ->on('users')
                ->cascadeOnDelete();
            $table->string('notification_type', 80);
            $table->boolean('email_enabled')
                ->default(true)
                ->comment('Whether the user wants to receive email notifications for this type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_preferences');
    }
};
