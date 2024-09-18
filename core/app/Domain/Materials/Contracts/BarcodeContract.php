<?php

namespace App\Domain\Materials\Contracts;

interface BarcodeContract
{
    public function getBarcode() : string;
    public function getBarcodeType() : string;
    public function getBarcodeHash() : string;
    public function getPartNumber() : string;
    public function getQuantity() : int;
    public function toArray() : array;
}
