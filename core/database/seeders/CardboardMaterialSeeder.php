<?php

namespace Database\Seeders;

use App\Models\CardboardMaterial;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;
use App\Support\CsvReader;

class CardboardMaterialSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * To regenerate csv file from legacy production, use this SQL statement:   
         * 
         * SELECT
         *     *
         * FROM cardboard_part_numbers
         * WHERE deleted_at IS NULL;
         */

         $file = database_path('data/cardboard_part_numbers.csv');
         $csvReader = new CsvReader($file);
 
        foreach ($csvReader->toArray() as $data) {
            foreach ($data as $key => $row) {

                $data[$key] = array_merge(
                    [
                        'part_number' => $row['part_number'],
                        'display_part_number' => $row['display_part_number'],
                        'customer_part_number' => $row['customer_part_number'] !== 'NULL' ? $row['customer_part_number'] : null,
                        'description' => $row['description'],
                        'quantity' => $row['quantity'],
                    ],
                    $this->getUuid(),
                    $this->getTimestamps()
                );

            }

            CardboardMaterial::insert($data);
        }
    }
}
