<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\ItemLocation;
use App\Models\RackLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Lottery;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialRequest>
 */
class MaterialRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = now();

        $item =  ItemLocation::where('item', 'REGEXP', '^[0-9]{6}$')
            ->inRandomOrder()
            ->value('item');

        $location = RackLocation::where([
                ['type', 20],
                ['disabled', 0]
            ])
            ->inRandomOrder()
            ->value('area');

        $notes = Lottery::odds(1, 6)->choose()
            ? fake()->text(40)
            : '';

        return [
            'emp' => Employee::inRandomOrder()->value('EMP_NUM'),
            'item' => $item,
            'invqty' => 1,
            'location' => $location,
            'specific_tote_id' => null,
            'delivery_document_item_id' => null,
            'date' => $now->toDateString(),
            'time' => $now->toTimeString(),
            'request_sts' => 0, // Open
            'notes' => $notes,
            'last_activity' => $now,
        ];
    }
}
