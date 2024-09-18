<?php

namespace Database\Factories;

use App\Domain\Materials\Enums\MovementStatus as MovementStatusEnum;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Domain\Materials\Support\Fakers\BarcodeFaker;
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
         *   use barcode to fill in blanks in factory fields
         *
         *   use material container data object to create instead
         */

        $barcode = BarcodeFactory::create( BarcodeFaker::make()->getBarcode() );

        $material = Material::where('part_number', $barcode->getPartNumber())->first();

        $materialContainerType = MaterialContainerType::inRandomOrder()->first();
        $storageLocation = StorageLocation::inRandomOrder()->first();
        $movementStatus = MovementStatus::where('code', MovementStatusEnum::UNRESTRICTED)->first();

        return [
            'uuid' => Str::uuid(),
            'material_id' => $material->id,
            'material_container_type_id' => $materialContainerType->id,
            'storage_location_id' => $storageLocation->id,
            'movement_status_id' => $movementStatus->id,
            'barcode' => $barcode->getBarcode(),
            'quantity' => $barcode->getQuantity(),
        ];
    }
}
