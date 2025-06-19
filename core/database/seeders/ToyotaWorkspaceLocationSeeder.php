<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\StorageLocation;
use App\Models\ToyotaWorkspaceLocation;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;
use App\Support\CsvReader;

class ToyotaWorkspaceLocationSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM tblwms_toyota_items;
         */

         $file = database_path('data/tblwms_toyota_items.csv');
         $csvReader = new CsvReader($file);
        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $materialUuid = Material::where('part_number', $row['item'])->first()->uuid;
                $storageLocationUuid = StorageLocation::where('name', $row['workspace_location_srlnum'])->first()->uuid;

                $data[$key] = array_merge(
                    [
                        'material_uuid' => $materialUuid,
                        'storage_location_uuid' => $storageLocationUuid,
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }

            ToyotaWorkspaceLocation::insert($data);
        }
    }
}
