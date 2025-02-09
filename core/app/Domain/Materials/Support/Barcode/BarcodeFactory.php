<?php

namespace App\Domain\Materials\Support\Barcode;

use App\Domain\Materials\Contracts\BarcodeContract;

class BarcodeFactory
{
    /**
     * Make a new barcode contract object based on the barcode type provided.
     */
    public static function make(string $barcode): BarcodeContract
    {
        if (strrpos($barcode, '/') === strlen($barcode) - 5) {
            $data = CompoundBarcodeParser::toData($barcode);

            return CompoundBarcode::from($data);
        }

        if (substr($barcode, 0, 3) === 'IRM') {
            $data = IrmBarcodeParser::toData($barcode);

            return IrmBarcode::from($data);
        }

        // if (substr($barcode, 0, 3) === 'FIX') {
            // $data = FixtureBarcodeParser::toData($barcode);

            // return FixtureBarcode::from($data);
        // }

        // if (substr($barcode, 0, 4) === 'MOLD') {
            // $data = MoldBarcodeParser::toData($barcode);

            // return MoldBarcode::from($data);
        // }

        $data = MaterialBarcodeParser::toData($barcode);

        return MaterialBarcode::from($data);
    }
}
