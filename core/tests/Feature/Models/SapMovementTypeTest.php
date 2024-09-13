<?php

namespace Tests\Feature\Models;

use App\Models\SapMovementType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SapMovementTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_types_seeded_in_database(): void
    {
        $file = fopen(database_path('data/sap_movement_types.csv'), 'r');

        $codes = [];

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $codes[] = $data[0];
        }

        $this->assertEquals(count($codes), SapMovementType::count());
    }
}
