<?php

namespace Database\Factories;

use App\Domain\Materials\Enums\MovementStatus as MovementStatusEnum;
use App\Models\Material;
use App\Models\MaterialContainerType;
use App\Models\MovementStatus;
use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaterialContainer>
 */
class MaterialContainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**
         * TODO:
         *   create barcode faker
         *   use it to fill in blanks in factory fields
         */

        $material = Material::inRandomOrder()->first();
        $materialContainerType = MaterialContainerType::inRandomOrder()->first();
        $storageLocation = StorageLocation::inRandomOrder()->first();
        $movementStatus = MovementStatus::where('code', MovementStatusEnum::UNRESTRICTED)->first();

        return [
            'uuid' => Str::uuid(),
            'material_id' => $material->id,
            'material_container_type_id' => $materialContainerType->id,
            'storage_location_id' => $storageLocation->id,
            'movement_status_id' => $movementStatus->id,
            'barcode' => fake()->bothify('  ########/##/##000000Q##0000#####       ??????####         ######     ######?00#######'),
            'quantity' => fake()->numberBetween(1, 500),
        ];
    }
}
