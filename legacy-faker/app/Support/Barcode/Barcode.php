<?php

namespace App\Support\Barcode;

use App\Contracts\BarcodeContract;

abstract class Barcode implements BarcodeContract
{
    protected string $barcode;

    protected string $barcodeType;

    protected string|null $clockNumber = null;

    protected string|null $expirationDate = null;

    protected string|null $lotNumber = null;

    protected string $partNumber;

    protected string|null $time = null;

    protected int|null $quantity;

    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct(string $barcode)
    {
        $this->setBarcode($barcode);
    }

    /**
     * Return the raw barcode string.
     */
    public function getBarcode() : string
    {
        return $this->barcode;
    }

    /**
     * Set the barcode string value.
     */
    public function setBarcode(string $barcode) : self
    {
        $this->barcode = trim($barcode);

        return $this;
    }

    /**
     * Return the type of barcode.
     */
    public function getBarcodeType() : string
    {
        return $this->barcodeType;
    }

    /**
     * Return the sha1 hash value of the trimmed barcode string.
     */
    public function getBarcodeHash() : string
    {
        return sha1( trim($this->getBarcode()) );
    }

    /**
     * Return the barcode clock number value.
     */
    public function getClockNumber() : string|null
    {
        return $this->clockNumber;
    }

    /**
     * Return the barcode expiration date value.
     */
    public function getExpirationDate() : string|null
    {
        return $this->expirationDate;
    }

    /**
     * Return the barcode lot number value.
     */
    public function getLotNumber() : string|null
    {
        return $this->lotNumber;
    }

    /**
     * Return the barcode part number value.
     */
    public function getPartNumber() : string
    {
        return $this->partNumber;
    }

    /**
     * Set the part number value parsed from the barcode string.
     */
    protected function setPartNumber(string $partNumber) : self
    {
        $this->partNumber = $partNumber;

        return $this;
    }

    /**
     * Return the barcode quantity value.
     */
    public function getQuantity() : int
    {
        return (int) $this->quantity;
    }

    /**
     * Set the quantity value parsed from the barcode string.
     */
    protected function setQuantity(int $quantity) : self
    {
        $this->quantity = (int) $quantity;

        return $this;
    }

    /**
     * Return the barcode time value.
     */
    public function getTime() : string|null
    {
        return $this->time;
    }

    /**
     * Return serialized instance of object.
     */
    public function toArray() : array
    {
        return [
            'barcode' => $this->getBarcode(),
            'barcodeType' => $this->getBarcodeType(),
            'barcodeHash' => $this->getBarcodeHash(),
            'clockNumber' => $this->getClockNumber(),
            'expirationDate' => $this->getExpirationDate(),
            'lotNumber' => $this->getLotNumber(),
            'partNumber' => $this->getPartNumber(),
            'time' => $this->getTime(),
            'quantity' => $this->getQuantity(),
        ];
    }
}
