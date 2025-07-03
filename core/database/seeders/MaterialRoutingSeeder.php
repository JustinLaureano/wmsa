<?php

namespace Database\Seeders;

use App\Models\CardboardMaterial;
use App\Models\Material;
use App\Models\MaterialRouting;
use App\Models\StorageLocationArea;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;
use App\Support\CsvReader;

class MaterialRoutingSeeder extends Seeder
{
    use Timestamps, Uuid;

    protected array $parts = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *    il.id,
         *    il.item,
         *    b_one.location AS building_one_area,
         *    b_two.location AS building_two_area,
         *    b_three.location AS building_three_area
         * FROM wms.tblwms_item_locations il
         * LEFT JOIN tblwms_item_locations_building_one b_one
         *     ON b_one.id = il.building_1_area
         * LEFT JOIN tblwms_item_locations_building_two b_two
         *     ON b_two.id = il.building_2_area
         * LEFT JOIN tblwms_item_locations_building_three b_three
         *     ON b_three.id = il.building_3_area
         * WHERE b_one.location NOT IN ('BFIX', 'PFIX')
         *     AND item NOT LIKE '%P1'
         * ORDER BY il.item ASC;
         */

         $file = database_path('data/item_locations.csv');
         $csvReader = new CsvReader($file);
 
        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $material = Material::where('part_number', $row['item'])->first();

                if (!$material) continue;

                if ( !isset($this->parts[$row['item']]) ) {
                    $this->parts[$row['item']] = [
                        'building_1' => 0,
                        'building_2' => 0,
                        'building_3' => 0,
                    ];
                }

                if ($row['building_one_area'] !== 'NULL' && $row['building_one_area'] !== 'SORT') {
                    $buildingOneArea = StorageLocationArea::where('name', $row['building_one_area'])->first();

                    $this->parts[$row['item']]['building_1']++;

                    $materialUuid = $material->uuid;
                    $buildingOneAreaUuid = $buildingOneArea->uuid;
                    $sequence = $this->parts[$row['item']]['building_1'];
                    $isPreferred = $this->parts[$row['item']]['building_1'] === 1;
                    $fallbackOrder = $this->parts[$row['item']]['building_1'] === 1
                        ? null
                        : $this->parts[$row['item']]['building_1'];
    
                    logger()->info($row);
                    $data[$key] = array_merge(
                        [
                            'material_uuid' => $materialUuid,
                            'storage_location_area_uuid' => $buildingOneAreaUuid,
                            'sequence' => $sequence,
                            'is_preferred' => $isPreferred,
                            'fallback_order' => $fallbackOrder,
                        ],
                        $this->getUuid(),
                        $this->getTimestamps()
                    );
                }
            }

            // MaterialRouting::insert($data);
        }
    }
}
