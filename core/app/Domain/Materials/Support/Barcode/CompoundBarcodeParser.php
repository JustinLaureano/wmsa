<?php

namespace App\Domain\Materials\Support\Barcode;

use App\Domain\Materials\DataTransferObjects\CompoundBarcodeData;

class CompoundBarcodeParser
{
    public function __construct(protected string $barcode)
    {
        $this->preformatBarcode();
    }

    public static function toData(string $barcode) : CompoundBarcodeData
    {
        $parser = new self($barcode);

        return new CompoundBarcodeData(
            barcode: $parser->getBarcode(),
            partNumber: $parser->parsePartNumber(),
            quantity: $parser->parseQuantity(),
            clockNumber: $parser->parseClockNumber(),
            runNumber: $parser->parseRunNumber(),
            expirationDate: $parser->parseExpirationDate()
        );
    }

    /**
     * Return the raw barcode string.
     */
    public function getBarcode() : string
    {
        return $this->barcode;
    }

    /**
     * Preformat the barcode string so that any parsing rules
     * will work as expected.
     */
    private function preformatBarcode() : void
    {
        /**
         * As of right now, we can expect that the barcode has
         * been preformatted correctly by the fact that the
         * barcode factory found the correct delimiters.
         */
    }

    /**
     * Parse and return the expiration date from the barcode.
     */
    private function parseExpirationDate() : string
    {
        return trim( substr($this->getBarcode(), 77, 10) );
    }

    /**
     * Parse and return the part number from the barcode.
     */
    private function parsePartNumber() : string
    {
        return trim( substr($this->getBarcode(), 0, 6) );
    }

    /**
     * Parse and return the quantity from the barcode.
     */
    private function parseQuantity() : int
    {
        return (int) trim( substr($this->getBarcode(), 31, 3) );
    }

    /**
     * Parse and return the run number from the barcode.
     */
    private function parseRunNumber() : string
    {
        return trim( substr($this->getBarcode(), 27, 3) );
    }

    /**
     * Parse and return the clock number from the barcode.
     */
    private function parseClockNumber() : string
    {
        // TODO: change
        return '6000';
    }
}
