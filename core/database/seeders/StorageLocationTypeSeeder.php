<?php

namespace Database\Seeders;

use App\Models\StorageLocationType;
use Illuminate\Database\Seeder;

class StorageLocationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/storage_location_types.csv'), 'r');

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
                'description' => $data[1],
                'default_max_containers' => $data[2] ?: null
            ];
        }

        StorageLocationType::insert($types);
    }
}
