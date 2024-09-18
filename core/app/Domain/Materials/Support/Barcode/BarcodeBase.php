<?php

namespace App\Domain\Materials\Support\Barcode;

abstract class BarcodeBase
{
    protected string $barcode;

    /** @var string */
    protected $barcodeType;

    /** @var string */
    protected string $partNumber;

    protected int|string|null $quantity;

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
    protected function setBarcode(string $barcode) : self
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
    public function getQuantity() : string|int|null
    {
        return $this->quantity;
    }

    /**
     * Set the quantity value parsed from the barcode string.
     */
    protected function setQuantity(string|int $quantity) : self
    {
        $this->quantity = (string) $quantity;

        return $this;
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
            'partNumber' => $this->getPartNumber(),
            'quantity' => $this->getQuantity(),
        ];
    }
}
