<?php

namespace App\Domain\Materials\Support\Fakers;

use App\Models\Material;
use App\Models\Teammate;
use Carbon\Carbon;
use Illuminate\Support\Lottery;

class BarcodeFaker
{
    protected string $barcode;

    public function __construct()
    {
        $this->generate();
    }

    /**
     * Return an instance of the Barcode Faker class.
     */
    public static function make() : BarcodeFaker
    {
        return new static();
    }

    /**
     * Get the barcode string.
     */
    public function getBarcode() : string
    {
        return $this->barcode;
    }

    /**
     * Generate a fake barcode string.
     */
    private function generate() : void
    {
        $partNumber = $this->randomPartNumber();

        $barcode = '';
        $barcode .= str_pad($partNumber, 8, ' ', STR_PAD_LEFT);
        $barcode .= $this->randomMfgDate();
        $barcode .= $this->randomQty();
        $barcode .= $this->randomClockNumber();
        $barcode .= $this->randomSupplierName();
        $barcode .= $this->randomTime();
        $barcode .= $this->randomSupplierPartNumber($partNumber);
        $barcode .= $this->randomLotNumber();
        $barcode .= $this->randomSerialNumber();

        $this->barcode = $barcode;
    }

    /**
     * Generate and return a random part number.
     */
    private function randomPartNumber() : string
    {
        $part =  Material::where('part_number', 'REGEXP', '^[0-9]{6}$')->inRandomOrder()->first()->part_number;

        return str_pad($part, 8, ' ', STR_PAD_LEFT);
    }

    /**
     * Generate and return a random mfg date.
     */
    private function randomMfgDate() : string
    {
        $date = fake()->dateTimeBetween(startDate: '-2 years');

        return (new Carbon($date))->format('m/d/y');
    }

    /**
     * Generate and return a random qty.
     */
    private function randomQty() : string
    {
        $qty = fake()->numberBetween(10, 1200);

        return str_pad('Q'.$qty, 8, '0', STR_PAD_LEFT);
    }

    /**
     * Generate and return a random clock number.
     */
    private function randomClockNumber() : string
    {
        $clockNumber =  Teammate::inRandomOrder()->first()->clock_number;

        return str_pad($clockNumber, 9, '0', STR_PAD_LEFT);
    }

    /**
     * Generate and return a random supplier name.
     */
    private function randomSupplierName() : string
    {
        $suppliers = [
            'EXPANSION',
            'HONDA',
            'INTERNAL',
            'NISSAN',
            'SUBARU',
            'TOYOTA',
            'TOYOTA DYNAMIG',
            'UPPER SANDUSKY',
            'YAT',
        ];

        $supplier = fake()->randomElement($suppliers);

        if ( strlen($supplier) > 13 ) {
            // This trim leaves some white space between fields
            $supplier = substr($supplier, 0, 11);
        }

        return str_pad($supplier, 13, ' ', STR_PAD_LEFT);
    }

    /**
     * Generate and return a random time.
     */
    private function randomTime() : string
    {
        return fake()->time('Hi');
    }

    /**
     * Generate and return a random supplier part number.
     *
     * The supplier part number is often the same as the
     * internal part number but not always, so this
     * will attempt to simulate that.
     */
    private function randomSupplierPartNumber(string $partNumber) : string
    {
        $number = Lottery::odds(1, 10)->choose()
            ? strtoupper( fake()->bothify('#####-#?###') )
            : $partNumber;

        return str_pad($number, 15, ' ', STR_PAD_LEFT);
    }

    /**
     * Generate and return a random lot number.
     */
    private function randomLotNumber() : string
    {
        $date = fake()->dateTimeBetween(startDate: '-2 years');

        $shift = fake()->randomElement(['A', 'B', 'C', '1', '2', '3']);

        $lot = (new Carbon($date))->format('mdy') . $shift;

        return str_pad($lot, 12, ' ', STR_PAD_LEFT);
    }

    /**
     * Generate and return a random serial number.
     */
    private function randomSerialNumber() : string
    {
        $value = fake()->ean8();

        $number = str_pad($value, 9, '0', STR_PAD_LEFT);

        return 'S'. $number;
    }
}
