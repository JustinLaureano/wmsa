<?php

namespace Tests\Feature\Models;

use App\Models\SapStorageLocationGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SapStorageLocationGroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_groups_seeded_in_database(): void
    {
        $file = fopen(database_path('data/sap_storage_location_groups.csv'), 'r');

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

        $groupCount = SapStorageLocationGroup::count();

        $this->assertEquals($seedCount, $groupCount);
    }
}
