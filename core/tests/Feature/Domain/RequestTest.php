<?php

namespace Tests\Feature\Domain;

use App\Models\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_requests_can_be_created(): void
    {
        Request::factory(2)->create();

        $this->assertDatabaseCount('requests', 2);
    }

    public function test_request_can_be_created(): void
    {
        $request = Request::factory()->create();

        $this->assertModelExists($request);
    }
}
