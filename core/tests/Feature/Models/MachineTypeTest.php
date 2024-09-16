<?php

namespace Tests\Feature\Models;

use App\Models\MachineType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MachineTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_machine_types_seeded_in_database(): void
    {
        $file = fopen(database_path('data/machine_types.csv'), 'r');

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

        $this->assertEquals($seedCount, MachineType::count());
    }
}
