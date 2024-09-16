<?php

namespace Database\Seeders;

use App\Domain\Locations\DataTransferObjects\StorageLocationAreaData;
use App\Models\Building;
use App\Models\StorageLocationArea;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class StorageLocationAreaSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setBuildingOneAreas();
        $this->setBuildingTwoAreas();
    }

    /**
     * Seed the building one storage location areas.
     */
    protected function setBuildingOneAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_one.csv'), 'r');
        $building = Building::where('name', 'Building 1 (Plant 2)')->first();
        $areas = [];
        $firstLine = true;

        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $area = new StorageLocationAreaData(
                building_id: $building->id,
                name: $data[0],
                description: $data[1],
                sap_storage_location_group: $data[2]
            );

            $areas[] = array_merge( $area->toArray(), $this->getTimestamps());
        }

        StorageLocationArea::insert($areas);
    }

    /**
     * Seed the building two storage location areas.
     */
    protected function setBuildingTwoAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_two.csv'), 'r');
        $building = Building::where('name', 'Building 2 (Blackhawk)')->first();
        $areas = [];
        $firstLine = true;

        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $area = new StorageLocationAreaData(
                building_id: $building->id,
                name: $data[0],
                description: $data[1],
                sap_storage_location_group: $data[2]
            );

            $areas[] = array_merge( $area->toArray(), $this->getTimestamps());
        }

        StorageLocationArea::insert($areas);
    }
}
