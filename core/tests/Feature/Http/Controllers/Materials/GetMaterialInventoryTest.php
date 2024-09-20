<?php

namespace Tests\Feature\Http\Controllers\Materials;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetMaterialInventoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_route_response(): void
    {
        $response = $this->get(route('materials.inventory'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
