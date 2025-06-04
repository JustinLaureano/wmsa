<?php

namespace Database\Factories;

use App\Domain\Materials\DataTransferObjects\MaterialContainerData;
use App\Domain\Materials\Enums\MovementStatusEnum;
use App\Domain\Materials\Support\Barcode\MaterialBarcodeFactory;
use App\Domain\Materials\Support\Fakers\BarcodeFaker;
use App\Models\Material;
use App\Models\MaterialContainerType;
use App\Models\MaterialToteType;
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
        $barcode = MaterialBarcodeFactory::make( BarcodeFaker::make()->getBarcode() );
        $material = Material::where('part_number', $barcode->getPartNumber())->first();
        $materialContainerType = MaterialContainerType::inRandomOrder()->first();
        $materialToteType = MaterialToteType::query()
            ->where('material_uuid', $material->uuid)
            ->inRandomOrder()
            ->first();
        $materialToteTypeUuid = $materialToteType ? $materialToteType->uuid : null;

        $statusCode = rand(1, 10) < 3
            ? MovementStatusEnum::RESTRICTED->value
            : MovementStatusEnum::UNRESTRICTED->value;

        $data = new MaterialContainerData(
            material_uuid: $material->uuid,
            material_container_type_id: $materialContainerType->id,
            material_tote_type_uuid: $materialToteTypeUuid,
            movement_status_code: $statusCode,
            barcode: $barcode->getBarcode(),
            lot_number: $barcode->getLotNumber(),
            quantity: $barcode->getQuantity(),
            expiration_date: $barcode->getExpirationDate()
        );

        return $data->toArray();
    }
}
