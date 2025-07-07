<?php

namespace Database\Seeders;

use App\Domain\Locations\Enums\BuildingIdEnum;
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
         * WHERE item NOT LIKE '%P1'
         * ORDER BY il.item ASC;
         */

         $file = database_path('data/item_locations.csv');
         $csvReader = new CsvReader($file);
 
        foreach ($csvReader->toArray() as $data) {
            $records = [];

            foreach ($data as $key => $row) {
                $material = Material::where('part_number', $row['item'])->first();

                if (!$material) continue;

                if ( !isset($this->parts[$row['item']]) ) {
                    $this->parts[$row['item']] = [
                        'building_1' => [
                            'count' => 0,
                            'areaIds' => [],
                        ],
                        'building_2' => [
                            'count' => 0,
                            'areaIds' => [],
                        ],
                        'building_3' => [
                            'count' => 0,
                            'areaIds' => [],
                        ],
                    ];
                }

                if (
                    $row['building_one_area'] !== 'NULL' &&
                    $row['building_one_area'] !== 'BFIX' &&
                    $row['building_one_area'] !== 'PFIX'
                ) {
                    $record = $this->getRoutingForBuilding(
                        buildingId: BuildingIdEnum::PLANT_2->value,
                        areaColumn: 'building_one_area',
                        partBuilding: 'building_1',
                        row: $row,
                        materialUuid: $material->uuid
                    );

                    if ($record) {
                        $records[] = $record;
                    }
                }

                if ($row['building_two_area'] !== 'NULL') {
                    $record = $this->getRoutingForBuilding(
                        buildingId: BuildingIdEnum::BLACKHAWK->value,
                        areaColumn: 'building_two_area',
                        partBuilding: 'building_2',
                        row: $row,
                        materialUuid: $material->uuid
                    );

                    if ($record) {
                        $records[] = $record;
                    }
                }

                if ($row['building_three_area'] !== 'NULL') {
                    $record = $this->getRoutingForBuilding(
                        buildingId: BuildingIdEnum::DEFIANCE->value,
                        areaColumn: 'building_three_area',
                        partBuilding: 'building_3',
                        row: $row,
                        materialUuid: $material->uuid
                    );

                    if ($record) {
                        $records[] = $record;
                    }
                }
            }

            MaterialRouting::insert($records);
        }
    }

    protected function getRoutingForBuilding(
        int $buildingId, // 1 | 2 | 3
        string $areaColumn, // building_one_area | building_two_area | building_three_area
        string $partBuilding, // building_1 | building_2 | building_3
        array $row,
        string $materialUuid
    ): array | null {

        if ($row[$areaColumn] === 'SORT') {
            $rowArea = 'COMPLETION';
        }
        else {
            $rowArea = $row[$areaColumn];
        }

        $storageLocationArea = StorageLocationArea::where(
            [
                'name' => $rowArea,
                'building_id' => $buildingId,
            ]
        )->first();

        if (
            !$storageLocationArea ||
            in_array($storageLocationArea->id, $this->parts[$row['item']][$partBuilding]['areaIds'])
        ) {
            return null;
        }

        $this->parts[$row['item']][$partBuilding]['areaIds'][] = $storageLocationArea->id;
        $this->parts[$row['item']][$partBuilding]['count']++;

        $storageLocationAreaId = $storageLocationArea->id;
        $sequence = $this->parts[$row['item']][$partBuilding]['count'];

        /**
         * Multiple flow rack options should all belong to the same sequence.
         * If a default flow rack has already been established, then the rest
         * should have a sequential fallback order.
         */
        if (str_contains($storageLocationArea->name, 'FLOW')) {
            $sequence = 1;
            if ($this->parts[$row['item']][$partBuilding]['count'] === 1) {
                $isPreferred = true;
            }
            else {
                $isPreferred = false;
            }
        }
        else {
            $isPreferred = true;
        }

        $fallbackOrder = $isPreferred
            ? null
            : ($sequence > 1 ? $sequence - 1 : 1);

        return array_merge(
            [
                'material_uuid' => $materialUuid,
                'building_id' => $buildingId,
                'storage_location_area_id' => $storageLocationAreaId,
                'sequence' => $sequence,
                'is_preferred' => $isPreferred,
                'fallback_order' => $fallbackOrder,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        );
    }
}
