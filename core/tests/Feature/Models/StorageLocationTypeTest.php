<?php

namespace Tests\Feature\Models;

use App\Models\StorageLocationType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StorageLocationTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
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
