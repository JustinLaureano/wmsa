<?php

namespace Tests\Feature\Models;

use App\Models\BuildingType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuildingTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_building_type(): void
    {
        $type = BuildingType::factory()->create([
            'name' => 'factory',
            'description' => 'produces materials'
        ]);

        $this->assertModelExists($type);
    }
}
