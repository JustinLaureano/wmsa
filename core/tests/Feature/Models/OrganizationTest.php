<?php

namespace Tests\Feature\Models;

use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_organization(): void
    {
        $org = Organization::factory()->create([
            'name' => 'Acme Co'
        ]);

        $this->assertModelExists($org);
    }
}
