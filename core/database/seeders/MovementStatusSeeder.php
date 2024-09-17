<?php

namespace Database\Seeders;

use App\Models\MovementStatus;
use Database\Seeders\Traits\Timestamps;
use Illuminate\Database\Seeder;

class MovementStatusSeeder extends Seeder
{
    use Timestamps;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/movement_statuses.csv'), 'r');

        $statuses = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $statuses[] = array_merge([
                'name' => $data[0],
                'description' => $data[1]
            ], $this->getTimestamps());
        }

        MovementStatus::insert($statuses);
    }
}
