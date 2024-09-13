<?php

namespace Tests\Feature\Models;

use App\Models\StorageLocationType;
use Tests\TestCase;

class StorageLocationTypeTest extends TestCase
{

    public function test_all_storage_location_types_seeded_in_database(): void
    {
        $file = fopen(database_path('data/storage_location_types.csv'), 'r');

        $seedCount = 0;

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $seedCount++;
        }

        $this->assertEquals($seedCount, StorageLocationType::count());
    }
}
