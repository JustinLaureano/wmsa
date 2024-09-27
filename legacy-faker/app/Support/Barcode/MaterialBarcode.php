<?php

namespace App\Support\Barcode;

use App\DataTransferObjects\MaterialBarcodeData;
use Carbon\Carbon;

class MaterialBarcode extends Barcode
{
    protected string $barcodeType = 'material';

    public function __construct(
        protected string $barcode,
        protected string $partNumber,
        protected int|null $quantity,
        private string $manufactureDate,
        private string $clockNumber,
        private string $supplier,
        private string $time,
        private string $supplierPartNumber,
        private string $lotNumber,
        private string $serialNumber
    )
    {
        //
    }

    public function __toString()
    {
        return $this->barcode;
    }

    public static function from(MaterialBarcodeData $data) : self
    {
        return new self(
            barcode: $data->barcode,
            partNumber: $data->partNumber,
            quantity: $data->quantity,
            manufactureDate: $data->manufactureDate,
            clockNumber: $data->clockNumber,
            supplier: $data->supplier,
            time: $data->time,
            supplierPartNumber: $data->supplierPartNumber,
            lotNumber: $data->lotNumber,
            serialNumber: $data->serialNumber
        );
    }

    /**
     * Return the barcode value.
     */
    public function getBarcode() : string
    {
        return $this->barcode;
    }

    /**
     * Return the manufacture date parsed from the barcode.
     */
    public function getManufactureDate() : string
    {
        return $this->manufactureDate;
    }

    /**
     * Return the quantity parsed from the barcode.
     */
    public function getQuantity() : int
    {
        return $this->quantity;
    }

    /**
     * Return the barcode clock number value.
     */
    public function getClockNumber() : string
    {
        return $this->clockNumber;
    }

    /**
     * Return the supplier parsed from the barcode.
     */
    public function getSupplier() : string
    {
        return $this->supplier;
    }

    /**
     * Return the supplier part number parsed from the barcode.
     */
    public function getSupplierPartNumber() : string
    {
        return $this->supplierPartNumber;
    }

    /**
     * Return the time parsed from the barcode.
     */
    public function getTime() : string
    {
        return $this->time;
    }

    /**
     * Return the barcode lot number value.
     */
    public function getLotNumber() : string
    {
        return $this->lotNumber;
    }

    /**
     * Return the serial number parsed from the barcode.
     */
    public function getSerialNumber() : string
    {
        return $this->serialNumber;
    }

    /**
     * Return the expiration date parsed from the barcode manufacture date.
     */
    public function getExpirationDate() : string
    {
        return $this->getExpiresAt()->toDateString();
    }

    /**
     * Return a Carbon instance for the expiration date of the barcode material.
     */
    public function getExpiresAt() : Carbon
    {
        return Carbon::createFromFormat(
                'm/d/y',
                $this->getManufactureDate()
            )
            ->addDays(30);
    }

    /**
     * Return a Carbon instance of the manufacture date of the barcode material.
     */
    public function getManufacturedAt() : Carbon
    {
        return Carbon::createFromFormat(
                'm/d/y',
                $this->getManufactureDate()
            );
    }

    /**
     * Return serialized instance of object.
     */
    public function toArray() : array
    {
        return [
            'barcode' => $this->getBarcode(),
            'barcode_type' => $this->getBarcodeType(),
            'barcode_hash' => $this->getBarcodeHash(),
            'clock_number' => $this->getClockNumber(),
            'expiration_date' => $this->getExpirationDate(),
            'expires_at' => $this->getExpiresAt(),
            'lot_number' => $this->getLotNumber(),
            'manufacture_date' => $this->getManufactureDate(),
            'manufactured_at' => $this->getManufacturedAt(),
            'part_number' => $this->getPartNumber(),
            'quantity' => $this->getQuantity(),
            'serial_number' => $this->getSerialNumber(),
            'supplier' => $this->getSupplier(),
            'supplier_part_number' => $this->getSupplierPartNumber(),
            'time' => $this->getTime(),
        ];
    }
}
