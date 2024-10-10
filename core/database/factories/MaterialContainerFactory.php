<?php

namespace Database\Factories;

use App\Domain\Materials\DataTransferObjects\MaterialContainerData;
use App\Domain\Materials\Enums\MovementStatusEnum;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Domain\Materials\Support\Fakers\BarcodeFaker;
use App\Models\Material;
use App\Models\MaterialContainerType;
use App\Models\MovementStatus;
use App\Models\StorageLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $barcode = BarcodeFactory::make( BarcodeFaker::make()->getBarcode() );
        $material = Material::where('part_number', $barcode->getPartNumber())->first();
        $materialContainerType = MaterialContainerType::inRandomOrder()->first();
        $storageLocation = StorageLocation::inRandomOrder()->first();
        $movementStatus = MovementStatus::where('code', MovementStatusEnum::UNRESTRICTED)->first();

        $data = new MaterialContainerData(
            material_uuid: $material->uuid,
            material_container_type_id: $materialContainerType->id,
            storage_location_uuid: $storageLocation->uuid,
            movement_status_id: $movementStatus->id,
            barcode: $barcode->getBarcode(),
            quantity: $barcode->getQuantity(),
        );

        return $data->toArray();
    }
}
