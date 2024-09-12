<?php

namespace Database\Seeders;

use App\Models\SapMovementType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SapMovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/sap_movement_types.csv'), 'r');

        $types = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $types[] = [
                'code' => $data[0],
                'description' => $data[1]
            ];
        }

        SapMovementType::insert($types);
    }
}
