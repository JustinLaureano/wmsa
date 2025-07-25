<?php

namespace Database\Seeders;

use App\Domain\Locations\DataTransferObjects\StorageLocationAreaData;
use App\Models\Building;
use App\Models\StorageLocationArea;
use App\Support\CsvReader;
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
        $this->setBuildingThreeAreas();
        $this->setBuildingFiveAreas();
        $this->setBuildingEightAreas();
        $this->setBuildingNineAreas();
        $this->setBuildingTenAreas();
        $this->setBuildingElevenAreas();
        $this->setMachineAreas();
    }

    /**
     * Seed the building one storage location areas.
     */
    protected function setBuildingOneAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_one.csv'), 'r');
        $building = Building::where('name', 'Plant 2')->first();
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
        $building = Building::where('name', 'Blackhawk')->first();
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
     * Seed the building three storage location areas.
     */
    protected function setBuildingThreeAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_three.csv'), 'r');
        $building = Building::where('name', 'Defiance')->first();
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
     * Seed the building five storage location areas.
     */
    protected function setBuildingFiveAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_five.csv'), 'r');
        $building = Building::where('name', 'Wharton')->first();
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
     * Seed the building eight storage location areas.
     */
    protected function setBuildingEightAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_eight.csv'), 'r');
        $building = Building::where('name', 'SJW')->first();
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
     * Seed the building nine storage location areas.
     */
    protected function setBuildingNineAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_nine.csv'), 'r');
        $building = Building::where('name', 'BWST')->first();
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
     * Seed the building ten storage location areas.
     */
    protected function setBuildingTenAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_ten.csv'), 'r');
        $building = Building::where('name', 'SANJI')->first();
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
     * Seed the building eleven storage location areas.
     */
    protected function setBuildingElevenAreas() : void
    {
        $file = fopen(database_path('data/storage_location_areas/building_eleven.csv'), 'r');
        $building = Building::where('name', 'OLG')->first();
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
     * Seed the machine storage location areas.
     */
    protected function setMachineAreas() : void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     id,
         *     building,
         *     REGEXP_REPLACE(area, 'Press[[:space:]]?[0-9]+', '') AS area,
         *     aisle,
         *     bay,
         *     shelf,
         *     position,
         *     type,
         *     split_request,
         *     disabled,
         *     exclude_allocations
         * FROM wms.tblwms_rack_location
         * WHERE type = 20
         * GROUP BY id
         * ORDER BY building ASC, area ASC;
         */

         $file = database_path('data/storage_locations/machines.csv');
        $csvReader = new CsvReader($file);
 
        foreach ($csvReader->toArray() as $data) {

            $records = [];
            foreach ($data as $key => $row) {

                $area = new StorageLocationAreaData(
                    building_id: $row['building'],
                    name: $row['area'],
                    description: $row['area'] . ' Staging',
                    sap_storage_location_group: 1000,
                );

                $records[] = array_merge(
                    $area->toArray(),
                    $this->getTimestamps()
                );
            }

            StorageLocationArea::insert($records);
        }
    }
}
