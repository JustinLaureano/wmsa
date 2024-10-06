<?php

namespace App\Repositories;

use App\Domain\Materials\Contracts\BarcodeContract;
use App\Domain\Materials\DataTransferObjects\MaterialContainerData;
use App\Domain\Materials\Enums\MovementStatus as MovementStatusEnum; 
use App\Models\MaterialContainer;

class MaterialContainerRepository
{
    public function create(MaterialContainerData $data) : MaterialContainer
    {
        return MaterialContainer::create($data->toArray());
    }

    public function findByBarcode(BarcodeContract $barcode)
    {
        return MaterialContainer::query()->whereBarcode($barcode->getBarcode())->first();
    }

    public function findOrCreate(BarcodeContract $barcode) : MaterialContainer
    {
        $container = $this->findByBarcode($barcode);

        if ($container) return $container;

        $material = (new MaterialRepository)->findByPartNumber($barcode->getPartNumber());

        $movementStatus = (new MovementStatusRepository)->findByCode(MovementStatusEnum::UNRESTRICTED);

        $data = new MaterialContainerData(
            material_uuid: $material->uuid,
            material_container_type_id: null,
            storage_location_uuid: null,
            movement_status_id: $movementStatus->id,
            barcode: $barcode->getBarcode(),
            quantity: $barcode->getQuantity(),
        );

        return $this->create($data);
    }
}
