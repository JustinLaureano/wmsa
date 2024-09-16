<?php

namespace Tests\Feature\Models;

use App\Models\Machine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MachineTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_machine(): void
    {
        $machine = Machine::factory()->create();

        $this->assertModelExists($machine);
    }
}
