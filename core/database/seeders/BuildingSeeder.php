<?php

namespace Database\Seeders;

use App\Models\Building;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/buildings.csv'), 'r');

        $buildings = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $buildings[] = array_merge([
                'organization_id' => $data[0],
                'name' => $data[1],
                'location' => $data[2],
                'building_type_id' => $data[3]
            ], $this->getTimestamps());
        }

        Building::insert($buildings);
    }
}
