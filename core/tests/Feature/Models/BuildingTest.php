<?php

namespace Tests\Feature\Models;

use App\Models\Building;
use App\Models\BuildingType;
use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuildingTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_building(): void
    {
        $org = Organization::factory()->create();
        $buildingType = BuildingType::factory()->create();

        $building = Building::factory()->create([
            'organization_id' => $org->id,
            'name' => 'Plant 1',
            'location' => 'Tijuana',
            'building_type_id' => $buildingType->id
        ]);

        $this->assertModelExists($building);
    }
}
