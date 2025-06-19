<?php

namespace Database\Seeders;

use App\Domain\Materials\DataTransferObjects\MaterialData;
use App\Domain\Materials\Enums\MaterialTypeEnum;
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
    protected array $irmChemicalPartNumbers = [];
    protected array $cementedMetalPartNumbers = [];
    protected array $materialProperties = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setMaterialContainerTypes();
        $this->setDescriptionContainerIds();
        $this->setIrmChemicalPartNumbers();
        $this->setCementedMetalPartNumbers();
        $this->setMaterialProperties();
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

                $materialContainerTypeId = $this->getMaterialContainerTypeId($row['part_number']);
                $materialTypeCode = $this->getMaterialTypeCode($row['part_number']);
                $expirationDays = $this->getExpirationDays($row['part_number']);
                $baseContainerUnitQuantity = $this->getBaseContainerUnitQuantity($row['part_number']);
                $requiredDegasHours = $this->getRequiredDegasHours($row['part_number']);
                $requiredHoldHours = $this->getRequiredHoldHours($row['part_number']);
                $servicePart = $this->getServicePart($row['part_number']);

                $materialData = new MaterialData(
                    material_number: $row['material_number'] ? $row['material_number'] : null,
                    part_number: $row['part_number'] ? $row['part_number'] : null,
                    description: $row['material_description'] ? $row['material_description'] : null,
                    material_type_code: $materialTypeCode,
                    base_quantity: $row['base_quantity'] ? (float) $row['base_quantity'] : null,
                    base_container_unit_quantity: $baseContainerUnitQuantity,
                    base_unit_of_measure: $row['base_unit_of_measure'] ? $row['base_unit_of_measure'] : strtoupper(UnitOfMeasureEnum::EA->value),
                    expiration_days: $expirationDays,
                    required_degas_hours: $requiredDegasHours,
                    required_hold_hours: $requiredHoldHours,
                    material_container_type_id: $materialContainerTypeId,
                    service_part: $servicePart,
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

    /**
     * Set the IRM chemicals.
     */
    protected function setIrmChemicalPartNumbers() : void
    {
        $file = database_path('data/irm_chemicals.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {
                $this->irmChemicalPartNumbers[$row['part_number']] = $row['part_number'];
            }
        }
    }

    /**
     * Set the cemented metal part numbers.
     */
    protected function setCementedMetalPartNumbers() : void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM tblwms_cemented_metal_safety_stock
         */
        $file = database_path('data/cemented_metal_safety_stock.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {
                $this->cementedMetalPartNumbers[$row['item']] = $row['item'];
            }
        }
    }

    /*
     * Set material properties.
     */
    protected function setMaterialProperties() : void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM tblwms_item
         */
        $file = database_path('data/tblwms_item.csv');
        $csvReader = new CsvReader($file);

        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {
                $this->materialProperties[$row['item']] = [
                    'hold_time' => $row['hold_time'],
                    'degas' => $row['degas'],
                    'service_part' => $row['service_part'],
                    'standard_pack_size' => $row['standard_pack_size'],
                ];
            }
        }
    }

    /**
     * Get the material container type id for a given part number.
     */
    protected function getMaterialContainerTypeId(string $partNumber) : int|null
    {
        if ( isset($this->baseContainerTypes[$partNumber]) ) {
            return $this->descriptionContainerIds[$this->baseContainerTypes[$partNumber]];
        }

        return null;
    }

    /**
     * Get the material type code for a given part number.
     */
    protected function getMaterialTypeCode(string $partNumber) : string|null
    {
        if ( isset($this->irmChemicalPartNumbers[$partNumber]) ) {
            return MaterialTypeEnum::IRM->code();
        }

        // General rule of thumb is that compound materials start with a 2.
        if ($partNumber[0] === '2') {
            return MaterialTypeEnum::COMPOUND->code();
        }

        if ( isset($this->cementedMetalPartNumbers[$partNumber]) ) {
            return MaterialTypeEnum::CEMENTED_METAL->code();
        }

        return null;
    }

    /**
     * Get the expiration days for a given part number.
     */
    protected function getExpirationDays(string $partNumber) : int|null
    {
        // General rule of thumb is that compound materials start with a 2.
        if ($partNumber[0] === '2') {
            return 30;
        }

        return null;
    }

    /**
     * Get the base container unit quantity for a given part number.
     */
    protected function getBaseContainerUnitQuantity(string $partNumber) : int|null
    {
        if ( isset($this->materialProperties[$partNumber]) ) {
            return (int) $this->materialProperties[$partNumber]['standard_pack_size'];
        }

        return null;
    }

    /**
     * Get the required degas hours for a given part number.
     */
    protected function getRequiredDegasHours(string $partNumber) : int|null
    {
        if ( isset($this->materialProperties[$partNumber]) ) {
            return (int) $this->materialProperties[$partNumber]['degas'];
        }

        return null;
    }

    /**
     * Get the required hold hours for a given part number.
     */
    protected function getRequiredHoldHours(string $partNumber) : int|null
    {
        if ( isset($this->materialProperties[$partNumber]) ) {
            return (int) $this->materialProperties[$partNumber]['hold_time'];
        }

        return null;
    }

    /**
     * Get the service part for a given part number.
     */
    protected function getServicePart(string $partNumber) : bool
    {
        if ( isset($this->materialProperties[$partNumber]) ) {
            return (bool) $this->materialProperties[$partNumber]['service_part'];
        }

        return false;
    }
}
