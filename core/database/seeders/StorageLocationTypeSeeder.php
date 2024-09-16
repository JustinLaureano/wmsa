<?php

namespace Database\Seeders;

use App\Models\StorageLocationType;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class StorageLocationTypeSeeder extends Seeder
{
    use Timestamps;

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

            $types[] = array_merge([
                'name' => $data[0],
                'description' => $data[1],
                'default_max_containers' => $data[2] ?: null
            ], $this->getTimestamps());
        }

        StorageLocationType::insert($types);
    }
}
