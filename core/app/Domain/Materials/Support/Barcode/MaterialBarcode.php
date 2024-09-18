<?php

namespace App\Domain\Materials\Support\Barcode;

use App\Exceptions\InvalidBarcodeException;
use Carbon\Carbon;

class MaterialBarcode extends BarcodeBase
{
    const BARCODE_STRING_LENGTH = 87;

    const EXPECTED_SLASH_POSITION = 10;

    protected $barcodeType = 'material';

    private string $manufactureDate;

    private string $clockNumber;

    private string $supplier;

    private string $time;

    private string $supplierPartNumber;

    private string $lotNumber;

    private string $serialNumber;

    public function __construct(protected string $barcode)
    {
        $this->preformatBarcode();
        $this->parsePartNumber();
        $this->parseManufactureDate();
        $this->parseQuantity();
        $this->parseClockNumber();
        $this->parseSupplier();
        $this->parseTime();
        $this->parseSupplierPartNumber();
        $this->parseLotNumber();
        $this->parseSerialNumber();
    }

    public function __toString()
    {
        return $this->barcode;
    }

    /**
     * Return the barcode value.
     */
    public function getBarcode() : string
    {
        return $this->barcode;
    }

    /**
     * Return the part number parsed from the barcode.
     */
    public function getPartNumber() : string
    {
        return $this->partNumber;
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
    private function parsePartNumber() : void
    {
        $partNumber = trim( substr($this->getBarcode(), 0, 8) );

        $this->setPartNumber($partNumber);
    }

    /**
     * Parse and set the manufacture date from the barcode.
     */
    private function parseManufactureDate() : void
    {
        $manufactureDate = substr($this->getBarcode(), 8, 8);

        if ( !preg_match('/\d{2}\/\d{2}\/\d{2}/', $manufactureDate) ) {
            throw new InvalidBarcodeException('Invalid Manufacture Date - ' . $this->getBarcode());
        }

        $this->manufactureDate = $manufactureDate;
    }

    /**
     * Parse and set the quantity from the barcode.
     */
    private function parseQuantity() : void
    {
        $quantitySection = substr($this->getBarcode(), 16, 8);

        $qPosition = strpos($quantitySection, 'Q');

        $quantity = substr($quantitySection, $qPosition + 1);

        $this->setQuantity((int) $quantity);
    }

    /**
     * Parse and set the clock number from the barcode.
     */
    private function parseClockNumber() : void
    {
        $clockNumberSection = substr($this->getBarcode(), 24, 9);

        $clockNumber = ltrim($clockNumberSection, '0');

        if ( strlen($clockNumber) < 4 ) {
            $clockNumber = str_pad($clockNumber, 4, '0', STR_PAD_LEFT);
        }

        $this->clockNumber = $clockNumber;
    }

    /**
     * Parse and set the supplier from the barcode.
     */
    private function parseSupplier() : void
    {
        $supplier = trim( substr($this->getBarcode(), 33, 13) );

        $this->supplier = $supplier;
    }

    /**
     * Parse and set the time from the barcode.
     */
    private function parseTime() : void
    {
        $time = substr($this->getBarcode(), 46, 4);

        if ( !preg_match('/\d{4}/', $time) ) {
            throw new InvalidBarcodeException('Invalid Time - ' . $this->getBarcode());
        }

        $this->time = $time;
    }

    /**
     * Parse and set the supplier part number from the barcode.
     */
    private function parseSupplierPartNumber() : void
    {
        $supplierPartNumber = trim( substr($this->getBarcode(), 50, 15) );

        $this->supplierPartNumber = $supplierPartNumber;
    }

    /**
     * Parse and set the lot number from the barcode.
     */
    private function parseLotNumber() : void
    {
        $lotNumber = trim( substr($this->getBarcode(), 65, 12) );

        $this->lotNumber = $lotNumber;
    }

    /**
     * Parse and set the serial number from the barcode.
     */
    private function parseSerialNumber() : void
    {
        $serialNumberSection = substr($this->getBarcode(), 77, 10);

        $sPosition = strpos($serialNumberSection, 'S');

        $serialNumber = substr($serialNumberSection, $sPosition + 1);

        $this->serialNumber = $serialNumber;
    }
}
