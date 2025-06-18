<?php

namespace Database\Seeders;

use App\Domain\Locations\DataTransferObjects\StorageLocationData;
use App\Domain\Locations\Enums\StorageLocationTypeEnum;
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
        $this->getAreaOptions();

        $this->setPalletRackStorageLocations();
        $this->setFloorStorageLocations();
        $this->setIrmStorageLocations();
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
        $type = StorageLocationType::where('name', StorageLocationTypeEnum::PALLET_RACK->value)->first();
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
                    restrict_request_allocations: $row['restrict_request_allocations'],
                    disabled: $row['disabled'],
                    reservable: $row['exclude_allocations'] ? 0 : 1
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

    /**
     * Seed the floor storage locations.
     */
    protected function setFloorStorageLocations() : void
    {
        $file = database_path('data/storage_locations/floor.csv');
        $type = StorageLocationType::where('name', StorageLocationTypeEnum::FLOOR->value)->first();
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                if ($row['aisle']) {
                    $name = $this->areas[$row['building']][$row['area']]['building_id']
                        .'-'. $row['area']
                        .'-'. $row['aisle']
                        .'-'. $row['bay']
                        .'-'. $row['shelf']
                        .'-'. $row['position'];
                }
                else {
                    $name = $row['area'];
                }

                $name = $this->setUniqueName($row['id'], $name);

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
                    max_containers: null,
                    restrict_request_allocations: $row['restrict_request_allocations'],
                    disabled: $row['disabled'],
                    reservable: $row['exclude_allocations'] ? 0 : 1
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

    /**
     * Set the IRM storage locations.
     */
    protected function setIrmStorageLocations() : void
    {
        $file = database_path('data/storage_locations/irm_locations.csv');
        $type = StorageLocationType::where('name', StorageLocationTypeEnum::FLOOR)->first();
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                if ($row['aisle']) {
                    $name = $this->areas[$row['building']][$row['area']]['building_id']
                        .'-'. $row['area']
                        .'-'. $row['aisle']
                        .'-'. $row['bay']
                        .'-'. $row['shelf']
                        .'-'. $row['position'];
                }
                else {
                    $name = $row['area'];
                }

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
                    max_containers: null,
                    restrict_request_allocations: $row['restrict_request_allocations'],
                    disabled: $row['disabled'],
                    reservable: $row['exclude_allocations'] ? 0 : 1
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

    /**
     * Set the unique name for the storage locations
     * that have a unique name structure, or return
     * the original name if not.
     */
    protected function setUniqueName(string $id, string $name) : string
    {
        $uniqueName = null;

        if ($id === '1-COMPLETION-0-0-0-0') {
            $uniqueName = 'Plant 2 Completion';
        }
        else if ($id === '2-COMPLETION-0-0-0-0') {
            $uniqueName = 'Blackhawk Completion';
        }
        else if ($id === '1-SORT-0-0-0-0') {
            $uniqueName = 'Plant 2 Sort';   
        }
        else if ($id === '2-SORT-0-0-0-0') {
            $uniqueName = 'Blackhawk Sort';
        }

        return $uniqueName ? $uniqueName : $name;
    }
}
