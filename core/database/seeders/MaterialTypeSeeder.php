<?php

namespace Database\Seeders;

use App\Models\MaterialType;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class MaterialTypeSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/material_types.csv'), 'r');

        $types = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $types[] = array_merge([
                'name' => $data[0],
                'code' => $data[1]
            ], $this->getTimestamps());
        }

        MaterialType::insert($types);
    }
}
