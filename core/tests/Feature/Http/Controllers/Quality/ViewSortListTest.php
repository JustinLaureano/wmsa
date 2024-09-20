<?php

namespace Tests\Feature\Http\Controllers\Quality;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ViewSortListTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_route_response(): void
    {
        $response = $this->get(route('quality.sort'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
