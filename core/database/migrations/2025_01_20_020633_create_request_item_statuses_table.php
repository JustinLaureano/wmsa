<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_item_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->unique();
            $table->string('name', 12);
            $table->text('description', 30);
        });

        Artisan::call('db:seed --class=RequestItemStatusSeeder');
    }

    public function down(): void
    {
        Schema::dropIfExists('request_item_statuses');
    }
};
