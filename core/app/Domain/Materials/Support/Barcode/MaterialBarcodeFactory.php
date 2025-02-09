<?php

namespace App\Domain\Materials\Support\Barcode;

class MaterialBarcodeFactory extends BarcodeFactory
{
    /**
     * Make a new material barcode object.
     */
    public static function make(string $barcode): MaterialBarcode
    {
        $data = MaterialBarcodeParser::toData($barcode);

        return MaterialBarcode::from($data);
    }
}