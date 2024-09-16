<?php

namespace Tests\Feature\Models;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $material = Material::factory()->create();

        $this->assertModelExists($material);
    }
}
