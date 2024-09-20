<?php

namespace Tests\Feature\Http\Controllers\Shipping;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ViewShippingRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_route_response(): void
    {
        $response = $this->get(route('shipping.requests'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
