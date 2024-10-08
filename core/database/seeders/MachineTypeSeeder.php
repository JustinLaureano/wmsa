<?php

namespace Database\Seeders;

use App\Models\MachineType;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class MachineTypeSeeder extends Seeder
{
    use Timestamps;

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

            $types[] = array_merge([
                'name' => $data[0],
                'description' => $data[1]
            ], $this->getTimestamps());
        }

        MachineType::insert($types);
    }
}
