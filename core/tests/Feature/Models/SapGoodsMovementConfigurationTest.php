<?php

namespace Tests\Feature\Models;

use App\Models\SapGoodsMovementConfiguration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SapGoodsMovementConfigurationTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_configs_seeded_in_database(): void
    {
        $file = fopen(database_path('data/sap_goods_movement_configuration.csv'), 'r');

        $configCount = 0;

        $firstLine = true;
        while ( ($data = fgetcsv($file, 2000, ",")) !== FALSE )
        {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $configCount++;
        }

        $this->assertEquals($configCount, SapGoodsMovementConfiguration::count());
    }
}
