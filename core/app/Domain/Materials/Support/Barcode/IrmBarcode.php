<?php

namespace App\Domain\Materials\Support\Barcode;

use App\Domain\Materials\DataTransferObjects\IrmBarcodeData;
use Carbon\Carbon;

class IrmBarcode extends Barcode
{
    protected string $barcodeType = 'irm';

    public function __construct(
        protected string $barcode,
        protected string $partNumber,
        protected int|null $quantity,
        private string $clockNumber,
        private string $runNumber,
        private string $expirationDate
    )
    {
        //
    }

    public function __toString()
    {
        return $this->barcode;
    }

    public static function from(IrmBarcodeData $data) : self
    {
        return new self(
            barcode: $data->barcode,
            partNumber: $data->partNumber,
            quantity: $data->quantity,
            clockNumber: $data->clockNumber,
            runNumber: $data->runNumber,
            expirationDate: $data->expirationDate
        );
    }

    /**
     * Return the barcode clock number value.
     */
    public function getClockNumber() : string
    {
        return $this->clockNumber;
    }

    /**
     * Return the barcode expiration date value.
     */
    public function getExpirationDate() : string
    {
        return $this->expirationDate;
    }

    /**
     * Return the barcode expiration date as a formatted string value.
     */
    public function getExpirationDateString() : string
    {
        return $this->getExpiresAt()->toDateString();
    }

    /**
     * Return a Carbon instance of the expiration date of the barcode material.
     */
    public function getExpiresAt() : Carbon
    {
        return Carbon::createFromFormat(
            'm/d/y',
            $this->getExpirationDate()
        );
    }

    /**
     * Return the run number parsed from the barcode.
     */
    public function getRunNumber() : int
    {
        return $this->runNumber;
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
            'expiration_date' => $this->getExpirationDateString(),
            'expires_at' => $this->getExpiresAt(),
            'part_number' => $this->getPartNumber(),
            'quantity' => $this->getQuantity(),
            'run_number' => $this->getRunNumber(),
        ];
    }
}
