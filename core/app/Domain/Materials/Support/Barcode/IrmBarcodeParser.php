<?php

namespace App\Domain\Materials\Support\Barcode;

use App\Domain\Materials\DataTransferObjects\IrmBarcodeData;

class IrmBarcodeParser
{
    // private Chemical $chemical;
    private $chemical;

    public function __construct(protected string $barcode)
    {
        $this->preformatBarcode();
        $this->setChemicalInformation();
    }

    public static function toData(string $barcode) : IrmBarcodeData
    {
        $parser = new self($barcode);

        return new IrmBarcodeData(
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

    private function setChemicalInformation() : void
    {
        /**
         * Barcode Format:
         *  IRM<ChemicalID>P<RunNumber>
         */

        // This signifies the start of the run number
        $firstPPos = strpos($this->getBarcode(), 'P');

        // Label starts with 'IRM'
        $chemicalId = substr($this->barcode, 3, $firstPPos - 3);

        // $this->chemical = Chemical::where('id', $chemicalId)->firstOrFail();
    }

    /**
     * Parse and return the expiration date from the barcode.
     */
    private function parseExpirationDate() : string
    {
        // TODO: change and/or remove if not needed
        return date('Y-m-d') . ' 00:00:00';
    }

    /**
     * Parse and return the part number from the barcode.
     */
    private function parsePartNumber() : string
    {
        return $this->chemical->part_number;
    }

    /**
     * Parse and return the quantity from the barcode.
     */
    private function parseQuantity() : int
    {
        return $this->chemical->lot_qty;
    }

    /**
     * Parse and return the run number from the barcode.
     */
    private function parseRunNumber() : string
    {
        $firstPPos = strpos($this->getBarcode(), 'P');

        return trim( substr($this->getBarcode(), $firstPPos + 1) );
    }

    /**
     * Parse and return the clock number from the barcode.
     */
    private function parseClockNumber() : string
    {
        // TODO: change and/or remove if needed
        return '6000';
    }
}
