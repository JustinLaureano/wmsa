<?php

namespace App\Domain\Materials\Support\Barcode;

use App\Domain\Materials\Contracts\BarcodeContract;

class BarcodeFactory
{
    public static function make($barcode): BarcodeContract
    {
        // if (strrpos($barcode, '/') === strlen($barcode) - 5) {
        //     return new CompoundBarcode($barcode);
        // }

        // if (substr($barcode, 0, 3) === 'IRM') {
        //     return new IRMBarcode($barcode);
        // }

        // if (substr($barcode, 0, 3) === 'FIX') {
        //     return new FixtureBarcode($barcode);
        // }

        // if (substr($barcode, 0, 4) === 'MOLD') {
        //     return new MoldBarcode($barcode);
        // }

        $data = MaterialBarcodeParser::toData($barcode);

        return MaterialBarcode::from($data);
    }
}
