<?php

namespace Database\Seeders;

use App\Models\SortListCustomer;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class SortListCustomerSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('data/sort_list_customers.csv'), 'r');

        $customers = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $customers[] = array_merge(
                [ 'name' => $data[0] ], 
                $this->getUuid(), 
                $this->getTimestamps()
            );
        }

        SortListCustomer::insert($customers);
    }
}
