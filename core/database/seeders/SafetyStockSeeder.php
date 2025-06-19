<?php

namespace Database\Seeders;

use App\Domain\Materials\Enums\UnitOfMeasureEnum;
use App\Models\Material;
use App\Models\SafetyStock;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class SafetyStockSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->setCementedMetalSafetyStock();
        $this->setCompoundSafetyStock();
        $this->setIrmChemicalSafetyStock();
    }

    public function setCementedMetalSafetyStock()
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM tblwms_cemented_metal_safety_stock;
         */

        $file = fopen(database_path('data/cemented_metal_safety_stock.csv'), 'r');

        $records = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $partNumber = $data[1];
            $building1SafetyStock = $data[2];
            $building2SafetyStock = $data[3];
            $notes = $data[4];
            $uom = str_contains($notes, 'pieces') ? UnitOfMeasureEnum::EA->value : UnitOfMeasureEnum::CONT->value;

            $materialUuid = Material::where('part_number', $partNumber)->first()->uuid;

            if ($building1SafetyStock !== 'NULL') {
                $records[] = array_merge([
                        'material_uuid' => $materialUuid,
                        'building_id' => 1,
                        'quantity' => $building1SafetyStock,
                        'unit_of_measure' => strtoupper($uom),
                        'notes' => $notes !== 'NULL' ? $notes : null,
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }

            if ($building2SafetyStock !== 'NULL') {
                $records[] = array_merge([
                        'material_uuid' => $materialUuid,
                        'building_id' => 2,
                        'quantity' => $building2SafetyStock,
                        'unit_of_measure' => strtoupper($uom),
                        'notes' => $notes !== 'NULL' ? $notes : null,
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }
        }

        SafetyStock::insert($records);
    }

    public function setCompoundSafetyStock()
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM tblwms_compound_safety_stock;
         */

        $file = fopen(database_path('data/compound_safety_stock.csv'), 'r');

        $records = [];
 
        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $partNumber = $data[1];
            $building1SafetyStock = $data[2];
            $building2SafetyStock = $data[3];
            $notes = $data[4];
            $uom = str_contains($notes, 'pieces') ? UnitOfMeasureEnum::EA->value : UnitOfMeasureEnum::CONT->value;

            $materialUuid = Material::where('part_number', $partNumber)->first()->uuid;

            if ($building1SafetyStock !== 'NULL') {
                $records[] = array_merge([
                        'material_uuid' => $materialUuid,
                        'building_id' => 1,
                        'quantity' => $building1SafetyStock,
                        'unit_of_measure' => strtoupper($uom),
                        'notes' => $notes !== 'NULL' ? $notes : null,
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }

            if ($building2SafetyStock !== 'NULL') {
                $records[] = array_merge([
                        'material_uuid' => $materialUuid,
                        'building_id' => 2,
                        'quantity' => $building2SafetyStock,
                        'unit_of_measure' => strtoupper($uom),
                        'notes' => $notes !== 'NULL' ? $notes : null,
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }
        }
 
        SafetyStock::insert($records);
    }

    public function setIrmChemicalSafetyStock()
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM irm_chemicals;
         */

        $file = fopen(database_path('data/irm_chemicals.csv'), 'r');

        $records = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $partNumber = $data[1];
            $building1SafetyStock = $data[8];
            $uom = UnitOfMeasureEnum::LB->value;

            $materialUuid = Material::where('part_number', $partNumber)->first()->uuid;

            if ($building1SafetyStock !== 'NULL') {
                $records[] = array_merge([
                        'material_uuid' => $materialUuid,
                        'building_id' => 1,
                        'quantity' => $building1SafetyStock,
                        'unit_of_measure' => strtoupper($uom),
                        'notes' => null,
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );
            }
        }

        SafetyStock::insert($records);
    }
}
