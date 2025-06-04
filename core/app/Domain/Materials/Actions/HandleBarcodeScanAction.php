<?php

namespace App\Domain\Materials\Actions;

use App\Domain\Materials\Contracts\BarcodeContract;
use App\Domain\Materials\Support\Barcode\BarcodeFactory;
use App\Domain\Materials\Support\Barcode\CompoundBarcode;
use App\Domain\Materials\Support\Barcode\MaterialBarcode;
use App\Models\MaterialContainer;
use App\Repositories\MaterialContainerRepository;

class HandleBarcodeScanAction
{
    public BarcodeContract|null $barcode = null;
    public MaterialContainer|null $container = null;
    public string $type = '';

    public function handle(string $barcode) : void
    {
        $barcodeLabel = BarcodeFactory::make($barcode);

        if ( $barcodeLabel instanceof MaterialBarcode ) {
            $this->barcode = $barcodeLabel;
            $this->container = (new MaterialContainerRepository)->findOrCreate($this->barcode);
            $this->type = 'material';
        }
        else if ( $barcodeLabel instanceof CompoundBarcode ) {
            $this->barcode = $barcodeLabel;
            $this->container = (new MaterialContainerRepository)->findOrCreate($this->barcode);
            $this->type = 'compound';
        }
        else {
            $this->barcode = $barcodeLabel;
            $this->container = null;
            $this->type = 'unknown';
        }
    }
}
