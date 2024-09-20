<?php

namespace Tests\Feature\Http\Controllers\Materials;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ViewMaterialsTest extends TestCase
{
    use RefreshDatabase;

    public function test_route_requires_authentication(): void
    {
        $response = $this->get(route('materials'));

        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function test_successful_route_response(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('materials'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
