<?php

namespace Database\Factories;

use App\Support\Barcode\BarcodeFactory;
use App\Support\Fakers\BarcodeFaker;
use App\Support\LotNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SkidItem>
 */
class SkidItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $barcode = BarcodeFactory::make( BarcodeFaker::make()->getBarcode() );

        return [
            'skid_id' => $barcode->getBarcodeHash(),
            'item' => $barcode->getPartNumber(),
            'lot' => $barcode->getLotNumber(),
            'qty' => $barcode->getQuantity(),
            'specific_tote_id' => null,
            'expire' => $barcode->getExpirationDate(),
            'emp_num' => $barcode->getClockNumber(),
            'time' => now(),
            'partial' => '0',
            'lot_timestamp' => LotNumber::lotToTimestamp($barcode->getLotNumber()),
            'run' => null,
            'locked' => 0,
            'departmental_part_type_id' => null,
            'barcode' => $barcode->getBarcode(),
        ];
    }
}
