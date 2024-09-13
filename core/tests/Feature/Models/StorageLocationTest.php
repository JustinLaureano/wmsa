<?php

namespace Tests\Feature\Models;

use App\Models\StorageLocation;
use App\Models\StorageLocationArea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorageLocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_storage_location(): void
    {
        StorageLocationArea::factory()->create();

        $location = StorageLocation::factory()->create();

        $this->assertModelExists($location);
    }
}
