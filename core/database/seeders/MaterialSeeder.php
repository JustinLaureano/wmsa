<?php

namespace Database\Seeders;

use App\Domain\Materials\DataTransferObjects\MaterialData;
use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Models\Material;
use App\Support\CsvReader;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    use Timestamps, Uuid;

    protected array $baseContainerTypes = [];
    protected array $descriptionContainerIds = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setMaterialContainerTypes();
        $this->setDescriptionContainerIds();
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

                if (isset($this->baseContainerTypes[$row['part_number']])) {
                    $materialContainerTypeId = $this->descriptionContainerIds[$this->baseContainerTypes[$row['part_number']]];
                }
                else {
                    $materialContainerTypeId = null;
                }

                $materialData = new MaterialData(
                    material_number: $row['material_number'] ? $row['material_number'] : null,
                    part_number: $row['part_number'] ? $row['part_number'] : null,
                    description: $row['material_description'] ? $row['material_description'] : null,
                    material_type_code: null,
                    base_quantity: $row['base_quantity'] ? (float) $row['base_quantity'] : null,
                    base_unit_of_measure: $row['base_unit_of_measure'] ? $row['base_unit_of_measure'] : strtoupper(UnitOfMeasureEnum::EA->value),
                    material_container_type_id: $materialContainerTypeId
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

    /**
     * Set all the base material container descriptions from seed data.
     */
    protected function setMaterialContainerTypes() : void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     DISTINCT part_number,
         *     container_description
         * FROM irm_chemicals
         * WHERE deleted_at IS NULL
         * ORDER BY part_number ASC;
         */
        $file = database_path('data/irm_chemical_container_types.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {
                $this->baseContainerTypes[$row['part_number']] = $row['container_description'];
            }
        }
    }

    /**
     * Match all of the container descriptions to their new corresponding ids.
     */
    protected function setDescriptionContainerIds() : void
    {
        $this->descriptionContainerIds = [
            'bag' => 6,
            'barrel' => 5,
            'basket' => 8,
            'bin' => 7,
            'box' => 2,
            'ropack' => 1,
            'skid' => 1,
            'tote' => 4,
        ];
    }
}
