<?php

namespace App\Repositories;

use App\Domain\Materials\Contracts\BarcodeContract;
use App\Domain\Materials\DataTransferObjects\MaterialContainerData;
use App\Domain\Materials\Enums\MovementStatusEnum;
use App\Models\MaterialContainer;
use App\Models\StorageLocation;

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

    public function findByUuid(string $uuid) : MaterialContainer
    {
        return MaterialContainer::query()->whereUuid($uuid)->first();
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
            movement_status_id: $movementStatus->id,
            barcode: $barcode->getBarcode(),
            quantity: $barcode->getQuantity(),
        );

        return $this->create($data);
    }

    /**
     * Return the storage location that the given material container is located at.
     */
    public function findLocation(string $material_container_uuid) : StorageLocation|null
    {
        return MaterialContainer::query()
            ->whereUuid($material_container_uuid)
            ->with('location')
            ->first()
            ?->location;
    }
}
