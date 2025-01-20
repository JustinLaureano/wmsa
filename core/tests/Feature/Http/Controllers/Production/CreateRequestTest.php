<?php

namespace Tests\Feature\Http\Controllers\Production;

use App\Models\Teammate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_route_requires_authentication(): void
    {
        $response = $this->get(route('production.material-request.new'));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function test_successful_route_response(): void
    {
        // $teammate = Teammate::factory()->create();

        // $response = $this->actingAs($teammate, 'teammate')->get(route('production.material-request.new'));

        // $response->assertStatus(Response::HTTP_OK);
    }
}
