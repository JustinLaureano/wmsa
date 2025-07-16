<?php

namespace Database\Seeders;

use App\Domain\Locations\Enums\BuildingIdEnum;
use App\Models\Material;
use App\Models\MaterialRouting;
use App\Models\MaterialToteType;
use App\Models\StorageLocationArea;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;
use App\Support\CsvReader;

class MaterialRoutingSeeder extends Seeder
{
    use Timestamps, Uuid;

    protected int $degasStorageLocationAreaId;
    protected array $parts = [];
    protected array $records = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setDegasStorageLocationAreaId();
        $this->setParts();
        $this->prepareBuilding(1);
        $this->prepareBuilding(2);
        $this->prepareBuilding(3);

        MaterialRouting::insert($this->records);

        $this->setMaterialToteTypes();

        if (app()->environment('local')) {
            $this->setTestMaterialRouting();
        }

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
         * ORDER BY il.item ASC, il.id ASC;
         */
    }

    protected function setParts(): void
    {
        $file = database_path('data/item_locations.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {
                $material = Material::query()
                   ->where('part_number', $row['item'])
                   ->first();

                if (!$material) continue;

                if ( !isset($this->parts[$row['item']]) ) {
                    $this->parts[$row['item']] = [
                        'material_uuid' => $material->uuid,
                        'building_1' => [
                            'areaIds' => [],
                        ],
                        'building_2' => [
                            'areaIds' => [],
                        ],
                        'building_3' => [
                            'areaIds' => [],
                        ],
                    ];
                }

                if (
                    $row['building_one_area'] !== 'NULL' &&
                    $row['building_one_area'] !== 'SORT' &&
                    $row['building_one_area'] !== 'COMPLETION' &&
                    $row['building_one_area'] !== 'BFIX' &&
                    $row['building_one_area'] !== 'PFIX'
                ) {
                    $storageLocationAreaId = $this->getStorageLocationAreaId(
                            $row['building_one_area'],
                            BuildingIdEnum::PLANT_2->value
                        );

                    if (
                        !in_array(
                            $storageLocationAreaId,
                            $this->parts[$row['item']]['building_1']['areaIds']
                        )
                    ) {
                        $this->parts[$row['item']]['building_1']['areaIds'][] = $storageLocationAreaId;
                    }
                }

                if (
                    $row['building_two_area'] !== 'NULL' &&
                    $row['building_two_area'] !== 'COMPLETION'
                ) {
                    // Anything on building two sort list should be a FG
                    if ($row['building_two_area'] === 'SORT') {
                        $row['building_two_area'] = 'FG';
                    }

                    $storageLocationAreaId = $this->getStorageLocationAreaId(
                            $row['building_two_area'],
                            BuildingIdEnum::BLACKHAWK->value
                        );
                    
                    if (
                        !in_array(
                            $storageLocationAreaId,
                            $this->parts[$row['item']]['building_2']['areaIds']
                        )
                    ) {
                        $this->parts[$row['item']]['building_2']['areaIds'][] = $storageLocationAreaId;
                    }
                }

                if ($row['building_three_area'] !== 'NULL')
                {
                    $storageLocationAreaId = $this->getStorageLocationAreaId(
                            $row['building_three_area'],
                            BuildingIdEnum::DEFIANCE->value
                        );

                    if (
                        !in_array(
                            $storageLocationAreaId,
                            $this->parts[$row['item']]['building_3']['areaIds']
                        )
                    ) {
                        $this->parts[$row['item']]['building_3']['areaIds'][] = $storageLocationAreaId;
                    }
                }
           }
       }
    }
    
    protected function getStorageLocationAreaId(string $areaName, int $buildingId): int
    {
        return StorageLocationArea::query()
            ->where([
                ['name', $areaName],
                ['building_id', $buildingId],
            ])
            ->first()
            ->id;
    }

    protected function prepareBuilding(int $buildingId): void
    {
        foreach ($this->parts as $part => $record) {
            $sequence = 1;
            $isPreferred = true;
            $fallbackOrder = null;

            foreach ($record['building_' . $buildingId]['areaIds'] as $areaId) {
                $this->records[] = array_merge([
                        'material_uuid' => $record['material_uuid'],
                        'material_tote_type_uuid' => null,
                        'route_building_id' => $buildingId,
                        'sequence' => $sequence,
                        'storage_location_area_id' => $areaId,
                        'is_preferred' => $isPreferred,
                        'fallback_order' => $fallbackOrder,
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );

                if ($isPreferred) {
                    $isPreferred = false;
                }

                if ($fallbackOrder === null) {
                    $fallbackOrder = 1;
                }
                else {
                    $fallbackOrder++;
                }

                /**
                 * Degas locations are a sequential sequence of locations.
                 */
                if ($areaId === $this->degasStorageLocationAreaId) {
                    $sequence++;
                    $isPreferred = true;
                    $fallbackOrder = null;
                }
            }
        }
    }

    protected function setDegasStorageLocationAreaId(): void
    {
        $storageLocationArea = StorageLocationArea::query()
            ->where('name', 'DGS')
            ->first();

        $this->degasStorageLocationAreaId = $storageLocationArea->id;
    }

    /**
     * Handle special material cases where a specific
     * tote type dictates the routing for the material.
     */
    protected function setMaterialToteTypes(): void
    {
        $flow16AreaId = StorageLocationArea::query()
            ->where('name', 'FLOW-16')
            ->first()
            ->id;

        $flow8AreaId = StorageLocationArea::query()
            ->where('name', 'FLOW-8')
            ->first()
            ->id;

        $material = Material::query()
            ->where('part_number', '300820')
            ->first();

        $materialToteType = MaterialToteType::query()
            ->where('tote', 'Dented')
            ->first();

        $records = [];

        $records[] = array_merge([
                'material_uuid' => $material->uuid,
                'material_tote_type_uuid' => $materialToteType->uuid,
                'route_building_id' => BuildingIdEnum::BLACKHAWK->value,
                'sequence' => 1,
                'storage_location_area_id' => $flow16AreaId,
                'is_preferred' => true,
                'fallback_order' => null,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        );

        $records[] = array_merge([
                'material_uuid' => $material->uuid,
                'material_tote_type_uuid' => $materialToteType->uuid,
                'route_building_id' => BuildingIdEnum::BLACKHAWK->value,
                'sequence' => 1,
                'storage_location_area_id' => $flow8AreaId,
                'is_preferred' => false,
                'fallback_order' => 1,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        );

        MaterialRouting::insert($records);
    }

    protected function setTestMaterialRouting(): void
    {
        /**
         * Want a test part that starts in one building, and then moves to another building.
         */

        $material = Material::query()
            ->where('part_number', '555555')
            ->first();

        $repackAreaId = StorageLocationArea::query()
            ->where([
                ['name', 'REPACK'],
                ['building_id', BuildingIdEnum::PLANT_2->value],
            ])
            ->first()
            ->id;

        $repack2AreaId = StorageLocationArea::query()
            ->where([
                ['name', 'REPACK 2'],
                ['building_id', BuildingIdEnum::BLACKHAWK->value],
            ])
            ->first()
            ->id;

        $repack2AreaId = StorageLocationArea::query()
            ->where([
                ['name', 'REPACK 2'],
                ['building_id', BuildingIdEnum::BLACKHAWK->value],
            ])
            ->first()
            ->id;

        $newLaunchAreaId = StorageLocationArea::query()
            ->where([
                ['name', 'NEW LAUNCH'],
                ['building_id', BuildingIdEnum::PLANT_2->value],
            ])
            ->first()
            ->id;

        $fgAreaId = StorageLocationArea::query()
            ->where([
                ['name', 'FG'],
                ['building_id', BuildingIdEnum::BLACKHAWK->value],
            ])
            ->first()
            ->id;

        $records = [];

        $records[] = array_merge([
                'material_uuid' => $material->uuid,
                'route_building_id' => BuildingIdEnum::PLANT_2->value,
                'sequence' => 1,
                'storage_location_area_id' => $repackAreaId,
                'is_preferred' => true,
                'fallback_order' => null,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        );

        $records[] = array_merge([
                'material_uuid' => $material->uuid,
                'route_building_id' => BuildingIdEnum::BLACKHAWK->value,
                'sequence' => 1,
                'storage_location_area_id' => $repack2AreaId,
                'is_preferred' => true,
                'fallback_order' => null,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        );

        $records[] = array_merge([
                'material_uuid' => $material->uuid,
                'route_building_id' => BuildingIdEnum::BLACKHAWK->value,
                'sequence' => 2,
                'storage_location_area_id' => $newLaunchAreaId,
                'is_preferred' => true,
                'fallback_order' => null,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        );

        $records[] = array_merge([
                'material_uuid' => $material->uuid,
                'route_building_id' => BuildingIdEnum::BLACKHAWK->value,
                'sequence' => 3,
                'storage_location_area_id' => $fgAreaId,
                'is_preferred' => true,
                'fallback_order' => null,
            ],
            $this->getUuid(),
            $this->getTimestamps()
        );

        MaterialRouting::insert($records);
    }
}
