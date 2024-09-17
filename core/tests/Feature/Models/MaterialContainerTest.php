<?php

namespace Tests\Feature\Models;

use App\Models\MaterialContainer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialContainerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_material_container(): void
    {
        $container = MaterialContainer::factory()->create();

        $this->assertModelExists($container);
    }
}
