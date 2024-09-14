<?php

namespace Database\Seeders;

use App\Domain\Locations\DataTransferObjects\StorageLocationData;
use App\Domain\Locations\Enums\StorageLocationType as StorageLocationTypeEnum;
use App\Models\StorageLocation;
use App\Models\StorageLocationArea;
use App\Models\StorageLocationType;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class StorageLocationSeeder extends Seeder
{
    use Timestamps, Uuid;

    protected array $areas;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setCurrentTime();

        $this->getAreaOptions();

        $this->setPalletRackStorageLocations();
    }

    /**
     * Get the storage location areas as options array.
     */
    protected function getAreaOptions() : void
    {
        $this->areas = StorageLocationArea::get()
            ->reduce(function (array $carry, StorageLocationArea $area) {
                if ( !isset($carry[$area->building_id]) ) {
                    $carry[$area->building_id] = [];
                }

                $carry[$area->building_id][$area->name] = [
                        'id' => $area->id,
                        'building_id' => $area->building_id
                    ];

                return $carry;
            }, []);
    }

    /**
     * Seed the pallet rack storage locations.
     */
    protected function setPalletRackStorageLocations() : void
    {
        $file = database_path('data/storage_locations/pallet_racks.csv');
        $type = StorageLocationType::where('name', StorageLocationTypeEnum::PALLET_RACK)->first();
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $name = $this->areas[$row['building']][$row['area']]['building_id'] 
                    .'-'. $row['area'] 
                    .'-'. $row['aisle'] 
                    .'-'. $row['bay'] 
                    .'-'. $row['shelf'] 
                    .'-'. $row['position'];

                $areaId = $this->areas[$row['building']][$row['area']]['id'];

                $locationData = new StorageLocationData(
                    name: $name,
                    barcode: $row['id'],
                    storage_location_type_id: $type->id,
                    storage_location_area_id: $areaId,
                    aisle: $row['aisle'],
                    bay: $row['bay'],
                    shelf: $row['shelf'],
                    position: $row['position'],
                    max_containers: 1,
                    disabled: $row['disabled'],
                    allocatable: $row['exclude_allocations'] ? 0 : 1
                );

                $data[$key] = array_merge(
                    $locationData->toArray(),
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }

            StorageLocation::insert($data);
        }
    }
}
