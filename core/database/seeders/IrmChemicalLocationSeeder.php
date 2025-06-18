<?php

namespace Database\Seeders;

use App\Domain\Irm\DataTransferObjects\IrmChemicalLocationData;
use App\Models\IrmChemical;
use App\Models\IrmChemicalLocation;
use App\Models\Material;
use App\Models\StorageLocation;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class IrmChemicalLocationSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setIrmChemicalLocations();
    }

    /**
     * Set the IRM chemical locations.
     */
    protected function setIrmChemicalLocations(): void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     ic.part_number,
         *     cl.rack_location_id,
         *     cl.qty,
         *     cl.stored_at,
         *     cl.updated_at
         * FROM wms.irm_chemical_locations cl
         * LEFT JOIN irm_chemicals ic
         *     ON ic.id = cl.irm_chemical_id
         * ORDER BY cl.stored_at ASC;
         */

        $file = database_path('data/irm_chemical_locations.csv');
        $csvReader = new CsvReader($file);
  
        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $materialUuid = Material::query()->where('part_number', $row['part_number'])->first()->uuid;
                $irmChemicalUuid = IrmChemical::query()->where('material_uuid', $materialUuid)->first()->uuid;
                $storageLocationUuid = StorageLocation::query()->where('name', $row['rack_location_id'])->first()->uuid;
 
                $irmChemicalLocationData = new IrmChemicalLocationData(
                    irm_chemical_uuid: $irmChemicalUuid,
                    storage_location_uuid: $storageLocationUuid,
                    quantity: (int) $row['qty']
                );

                $data[$key] = array_merge(
                    $irmChemicalLocationData->toArray(),
                    $this->getUuid(),
                    [
                        'created_at' => $row['stored_at'],
                        'updated_at' => $row['updated_at'] !== 'NULL' ? $row['updated_at'] : $row['stored_at'],
                    ]
                );
            }

            IrmChemicalLocation::insert($data);
        }
    }
}
