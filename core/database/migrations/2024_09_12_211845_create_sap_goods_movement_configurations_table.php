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
        Schema::create('sap_goods_movement_configuration', function (Blueprint $table) {
            $table->id();
            $table->string('from_wms_category', 20);
            $table->string('to_wms_category', 20);
            $table->string('transfer_description', 255);
            $table->tinyInteger('active_inspection');
            $table->string('gm_code', 2);
            $table->string('posting_date_format', 10);
            $table->string('doc_date_format', 10);
            $table->tinyInteger('ref_doc_no_required');
            $table->tinyInteger('header_text_required');
            $table->tinyInteger('material_required');
            $table->string('plant', 8);
            $table->tinyInteger('storage_location_required');
            $table->string('move_type', 4);
            $table->string('movement_indicator', 1);
            $table->string('stock_type', 1);
            $table->tinyInteger('entry_quantity_required');
            $table->tinyInteger('entry_uom_required');
            $table->tinyInteger('po_number_required');
            $table->tinyInteger('po_item_required');
            $table->tinyInteger('order_id_required');
            $table->string('move_plant', 8);
            $table->tinyInteger('move_storage_location_required');
            $table->tinyInteger('vendor_required');
        });

        Artisan::call('db:seed --class=SapGoodsMovementConfigurationSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sap_goods_movement_configuration');
    }
};
