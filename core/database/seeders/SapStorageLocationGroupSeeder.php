<?php

namespace Database\Seeders;

use App\Models\SapStorageLocationGroup;
use Illuminate\Database\Seeder;

class SapStorageLocationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/sap_storage_location_groups.csv'), 'r');

        $groups = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $groups[] = [
                'system' => $data[0],
                'location_group' => $data[1],
                'category' => $data[2]
            ];
        }

        SapStorageLocationGroup::insert($groups);
    }
}
