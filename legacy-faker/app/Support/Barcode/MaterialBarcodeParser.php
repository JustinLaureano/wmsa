<?php

namespace App\Support\Barcode;

use App\DataTransferObjects\MaterialBarcodeData;
use App\Exceptions\InvalidBarcodeException;

class MaterialBarcodeParser
{
    const BARCODE_STRING_LENGTH = 87;

    const EXPECTED_SLASH_POSITION = 10;

    public function __construct(protected string $barcode)
    {
        $this->preformatBarcode();
    }

    public static function toData(string $barcode) : MaterialBarcodeData
    {
        $parser = new self($barcode);

        return new MaterialBarcodeData(
            barcode: $parser->getBarcode(),
            partNumber: $parser->parsePartNumber(),
            quantity: $parser->parseQuantity(),
            manufactureDate: $parser->parseManufactureDate(),
            clockNumber: $parser->parseClockNumber(),
            supplier: $parser->parseSupplier(),
            time: $parser->parseTime(),
            supplierPartNumber: $parser->parseSupplierPartNumber(),
            lotNumber: $parser->parseLotNumber(),
            serialNumber: $parser->parseSerialNumber()
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
     * Preformat the barcode string so that the barcode
     * length is the appropriate expected length to
     * parse correctly based on formatting rules.
     *
     * We need to do this incase the barcode input field
     * had any extra spaces or characters captured
     * at the beginning of the string.
     */
    private function preformatBarcode() : void
    {
        $origBarcode = $this->barcode;
        $slashPosition = strpos($this->barcode, '/');

        if ( $slashPosition === false ) {
            /**
             * All material barcodes should have a '/' character in the
             * manufacture date, right after the part number. If it
             * is not included in the string, it must be wrong.
             */
            throw new InvalidBarcodeException('Invalid barcode string - ' . $origBarcode);
        }

        if ( $slashPosition < self::EXPECTED_SLASH_POSITION ) {
            /**
             * If the barcode string is too short, it may be that
             * the barcode string had the leading white space
             * trimmed. This will re-add that leading white space.
             */
            $diff = self::EXPECTED_SLASH_POSITION - $slashPosition;
            $barcodeLength = strlen($this->barcode);

            $this->barcode = str_pad($this->barcode, $barcodeLength + $diff, ' ', STR_PAD_LEFT);
        }

        else if ( strlen($this->barcode) > self::BARCODE_STRING_LENGTH ) {
            /**
             * If the barcode string is too long, then the barcode input
             * field may have had extra spaces or characters captured
             * before the actual barcode value. This will remove that
             * white space from the start of the barcode string.
             */
            $diff = strlen($this->barcode) - self::BARCODE_STRING_LENGTH;

            $this->barcode = substr($this->barcode, $diff);
        }

        if ( strlen($this->barcode) !== self::BARCODE_STRING_LENGTH ) {
            /**
             * After pre-formatting, if the barcode is not the correct length,
             * then it must be invalid and should not be parsed.
             */
            throw new InvalidBarcodeException('Invalid barcode length - '. $origBarcode);
        }
    }

    /**
     * Parse and set the part number from the barcode.
     */
    private function parsePartNumber() : string
    {
        $partNumber = trim( substr($this->getBarcode(), 0, 8) );

        return $partNumber;
    }

    /**
     * Parse and set the manufacture date from the barcode.
     */
    private function parseManufactureDate() : string
    {
        $manufactureDate = substr($this->getBarcode(), 8, 8);

        if ( !preg_match('/\d{2}\/\d{2}\/\d{2}/', $manufactureDate) ) {
            throw new InvalidBarcodeException('Invalid Manufacture Date - ' . $this->getBarcode());
        }

        return $manufactureDate;
    }

    /**
     * Parse and set the quantity from the barcode.
     */
    private function parseQuantity() : int
    {
        $quantitySection = substr($this->getBarcode(), 16, 8);

        $qPosition = strpos($quantitySection, 'Q');

        $quantity = substr($quantitySection, $qPosition + 1);

        return (int) $quantity;
    }

    /**
     * Parse and set the clock number from the barcode.
     */
    private function parseClockNumber() : string
    {
        $clockNumberSection = substr($this->getBarcode(), 24, 9);

        $clockNumber = ltrim($clockNumberSection, '0');

        if ( strlen($clockNumber) < 4 ) {
            $clockNumber = str_pad($clockNumber, 4, '0', STR_PAD_LEFT);
        }

        return $clockNumber;
    }

    /**
     * Parse and set the supplier from the barcode.
     */
    private function parseSupplier() : string
    {
        $supplier = trim( substr($this->getBarcode(), 33, 13) );

        return $supplier;
    }

    /**
     * Parse and set the time from the barcode.
     */
    private function parseTime() : string
    {
        $time = substr($this->getBarcode(), 46, 4);

        if ( !preg_match('/\d{4}/', $time) ) {
            throw new InvalidBarcodeException('Invalid Time - ' . $this->getBarcode());
        }

        return $time;
    }

    /**
     * Parse and set the supplier part number from the barcode.
     */
    private function parseSupplierPartNumber() : string
    {
        $supplierPartNumber = trim( substr($this->getBarcode(), 50, 15) );

        return $supplierPartNumber;
    }

    /**
     * Parse and set the lot number from the barcode.
     */
    private function parseLotNumber() : string
    {
        $lotNumber = trim( substr($this->getBarcode(), 65, 12) );

        return $lotNumber;
    }

    /**
     * Parse and set the serial number from the barcode.
     */
    private function parseSerialNumber() : string
    {
        $serialNumberSection = substr($this->getBarcode(), 77, 10);

        $sPosition = strpos($serialNumberSection, 'S');

        $serialNumber = substr($serialNumberSection, $sPosition + 1);

        return $serialNumber;
    }
}
