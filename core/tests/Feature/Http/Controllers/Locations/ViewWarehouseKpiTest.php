<?php

namespace Tests\Feature\Http\Controllers\Locations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewWarehouseKpiTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_route_response(): void
    {
        $response = $this->get(route('locations.buildings.kpi'));

        $response->assertStatus(200);
    }
}
