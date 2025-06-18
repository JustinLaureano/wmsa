<?php

namespace Database\Seeders;

use App\Domain\Irm\DataTransferObjects\IrmChemicalData;
use App\Models\IrmChemical;
use App\Models\Material;
use App\Models\StorageLocation;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class IrmChemicalSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setIrmChemicals();
    }

    /**
     * Seed the IRM chemicals.
     */
    protected function setIrmChemicals(): void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM wms.irm_chemicals
         * WHERE deleted_at IS NULL
         * ORDER BY part_number ASC;
         */

        $file = database_path('data/irm_chemicals.csv');
        $csvReader = new CsvReader($file);
 
        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {
                
                logger($row['part_number']);
                $materialUuid = Material::query()->where('part_number', $row['part_number'])->first()->uuid;
                if ($row['assigned_rack_location_id'] !== 'NULL') {
                    $assignedStorageLocationUuid = StorageLocation::query()->where('name', $row['assigned_rack_location_id'])->first()->uuid;
                }
                else {
                    $assignedStorageLocationUuid = null;
                }

                if ($row['drop_off_rack_location_id'] !== 'NULL') {
                    $dropOffStorageLocationUuid = StorageLocation::query()->where('name', $row['drop_off_rack_location_id'])->first()->uuid;
                }
                else {
                    $dropOffStorageLocationUuid = null;
                }

                $irmChemicalData = new IrmChemicalData(
                    material_uuid: $materialUuid,
                    lot_quantity: (int) $row['lot_qty'],
                    unit_quantity: (int) $row['unit_qty'],
                    assigned_storage_location_uuid: $assignedStorageLocationUuid,
                    drop_off_storage_location_uuid: $dropOffStorageLocationUuid
                );

                $data[$key] = array_merge(
                    $irmChemicalData->toArray(),
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }
 
            IrmChemical::insert($data);
        }
    }
}
