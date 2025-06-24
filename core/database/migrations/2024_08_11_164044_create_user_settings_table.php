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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('user_uuid')
                ->references('uuid')
                ->on('users')
                ->cascadeOnDelete();
            $table->enum('locale', ['en', 'es'])
                ->default('en')
                ->comment('The default locale of the user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
