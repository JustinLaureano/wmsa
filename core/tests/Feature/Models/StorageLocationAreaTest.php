<?php

namespace Tests\Feature\Models;

use App\Models\Building;
use App\Models\StorageLocationArea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorageLocationAreaTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_storage_location_area(): void
    {
        $area = StorageLocationArea::factory()->create();

        $this->assertModelExists($area);
    }
}
