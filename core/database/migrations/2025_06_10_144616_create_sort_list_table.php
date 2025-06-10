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
        Schema::create('sort_list', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->foreignUuid('sort_list_customer_uuid')
                ->references('uuid')
                ->on('sort_list_customers');
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials');
            $table->enum('type', [
                'internal',
                'customer',
                'launch',
                ])
                ->default('internal');
            $table->enum('status', [
                'open',
                'pending',
                'in_progress',
                'closed',
                ])
                ->default('open');
            $table->text('reason')->nullable();
            $table->smallInteger('percent')->nullable();
            $table->string('standard_time', 20)->nullable();
            $table->string('cert', 12)->nullable();
            $table->tinyInteger('line_side_sort')->default(0);
            $table->date('list_date')->nullable();
            $table->date('close_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sort_list');
    }
};
