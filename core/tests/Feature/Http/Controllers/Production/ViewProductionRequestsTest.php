<?php

namespace Tests\Feature\Http\Controllers\Production;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ViewProductionRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_route_response(): void
    {
        $response = $this->get(route('production.requests'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
