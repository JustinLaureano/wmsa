<?php

namespace Tests\Feature\Models;

use App\Models\Building;
use App\Models\StorageLocationArea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorageLocationAreaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        Building::factory()->create();

        $area = StorageLocationArea::factory()->create();

        $this->assertModelExists($area);
    }
}
