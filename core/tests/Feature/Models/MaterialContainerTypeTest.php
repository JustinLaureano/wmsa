<?php

namespace Tests\Feature\Models;

use App\Models\MaterialContainerType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialContainerTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_material_container_types_seeded_in_database(): void
    {
        $file = fopen(database_path('data/material_container_types.csv'), 'r');

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

        $this->assertEquals($seedCount, MaterialContainerType::count());
    }
}
