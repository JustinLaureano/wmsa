<?php

namespace Database\Seeders;

use App\Models\MachineType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/machine_types.csv'), 'r');

        $types = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $types[] = [
                'name' => $data[0],
                'description' => $data[1]
            ];
        }

        MachineType::insert($types);
    }
}
