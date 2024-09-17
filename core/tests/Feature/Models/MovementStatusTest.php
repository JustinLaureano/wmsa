<?php

namespace Tests\Feature\Models;

use App\Models\MovementStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovementStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_movement_statuses_seeded_in_database(): void
    {
        $file = fopen(database_path('data/movement_statuses.csv'), 'r');

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

        $this->assertEquals($seedCount, MovementStatus::count());
    }
}
