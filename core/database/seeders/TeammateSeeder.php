<?php

namespace Database\Seeders;

use App\Models\Teammate;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class TeammateSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/teammates.csv'), 'r');

        $teammates = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $teammates[] = array_merge([
                'clock_number' => $data[0],
                'organization_id' => $data[1],
                'first_name' => $data[2],
                'last_name' => $data[3],
                'hire_date' => $data[4],
            ], $this->getTimestamps());
        }

        Teammate::insert($teammates);
    }
}
