<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MaterialToteType;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MaterialToteTypeSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:
         * 
         * SELECT 
         *     item AS part_number,
         *     tote,
         *     IF(description <> '', description, NULL) AS description
         * FROM
         *     wms.tblwms_tote_specific_items
         * WHERE
         *     deleted_at IS NULL
         * ORDER BY item ASC;
         */

        $file = fopen(database_path('data/material_tote_types.csv'), 'r');

        $types = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $materialUuid = Material::where('part_number', $data[0])
                ->first()
                ->uuid;

            $types[] = array_merge([
                'uuid' => Str::uuid(),
                'material_uuid' => $materialUuid,
                'tote' => $data[1],
                'description' => $data[2] ? $data[2] : null
            ], $this->getTimestamps());
        }

        MaterialToteType::insert($types);
    }
}
