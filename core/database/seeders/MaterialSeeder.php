<?php

namespace Database\Seeders;

use App\Domain\Materials\DataTransferObjects\MaterialData;
use App\Models\Material;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setMaterials();
    }

    /**
     * Seed the materials.
     */
    protected function setMaterials() : void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     p.psam_part_number AS material_number,
         *     p.bapm_part_number AS part_number,
         *     m.material_description,
         *     p.base_quantity,
         *     p.base_unit_of_measure
         * FROM prospira_web.parts p
         * LEFT JOIN sap_materials m
         *     ON m.bapm_part_number = p.bapm_part_number
         * ORDER BY p.bapm_part_number ASC;
         */

        $file = database_path('data/materials.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $materialData = new MaterialData(
                    material_number: $row['material_number'],
                    part_number: $row['part_number'],
                    description: $row['material_description'],
                    material_type_code: null,
                    base_quantity: (float) $row['base_quantity'],
                    base_unit_of_measure: $row['base_unit_of_measure']
                );

                $data[$key] = array_merge(
                    $materialData->toArray(),
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }

            Material::insert($data);
        }
    }
}
