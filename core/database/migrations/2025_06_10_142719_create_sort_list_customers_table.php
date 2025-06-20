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
        Schema::create('sort_list_customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed --class=SortListCustomerSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sort_list_customers');
    }
};
