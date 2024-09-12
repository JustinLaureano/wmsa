<?php

namespace Database\Seeders;

use App\Models\SapGoodsMovementConfiguration;
use Illuminate\Database\Seeder;

class SapGoodsMovementConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/sap_goods_movement_configuration.csv'), 'r');

        $configs = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $configs[] = [
                'from_wms_category' => $data[0],
                'to_wms_category' => $data[1],
                'transfer_description' => $data[2],
                'active_inspection' => $data[3],
                'gm_code' => $data[4],
                'posting_date_format' => $data[5],
                'doc_date_format' => $data[6],
                'ref_doc_no_required' => $data[7],
                'header_text_required' => $data[8],
                'material_required' => $data[9],
                'plant' => $data[10],
                'storage_location_required' => $data[11],
                'move_type' => $data[12],
                'movement_indicator' => $data[13],
                'stock_type' => $data[14],
                'entry_quantity_required' => $data[15],
                'entry_uom_required' => $data[16],
                'po_number_required' => $data[17],
                'po_item_required' => $data[18],
                'order_id_required' => $data[19],
                'move_plant' => $data[20],
                'move_storage_location_required' => $data[21],
                'vendor_required' => $data[22]
            ];
        }

        SapGoodsMovementConfiguration::insert($configs);
    }
}
