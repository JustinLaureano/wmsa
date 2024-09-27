<?php

namespace App\Contracts;

interface BarcodeContract
{
    public function getBarcode() : string;
    public function getBarcodeType() : string;
    public function getBarcodeHash() : string;
    public function getClockNumber() : string|null;
    public function getExpirationDate() : string|null;
    public function getLotNumber() : string|null;
    public function getPartNumber() : string;
    public function getQuantity() : int;
    public function getTime() : string|null;
    public function toArray() : array;
}
