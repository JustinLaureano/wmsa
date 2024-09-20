<?php

namespace Tests\Feature\Http\Controllers\Irm;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetIrmInventoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_route_response(): void
    {
        $response = $this->get(route('irm.chemicals.inventory'));

        $response->assertStatus(200);
    }
}
