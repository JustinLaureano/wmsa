<?php

use App\Models\MaterialContainerType;
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
        Schema::create('material_containers', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignUuid('material_uuid')
                ->references('uuid')
                ->on('materials');
            $table->foreignIdFor(MaterialContainerType::class)->nullable();
            $table->foreignUuid('material_tote_type_uuid')
                ->references('uuid')
                ->on('material_tote_types')
                ->nullable();
            $table->string('movement_status_code')
                ->references('code')
                ->on('movement_statuses');
            $table->string('barcode', 100)->index();
            $table->string('lot_number', 12);
            $table->integer('quantity');
            $table->date('expiration_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_containers');
    }
};
