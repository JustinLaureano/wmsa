<?php

namespace Database\Seeders;

use App\Models\DeliveryDocument;
use Illuminate\Database\Seeder;

class DeliveryDocumentSeeder extends Seeder
{
    public function run()
    {
        DeliveryDocument::factory()
            ->count(30)
            ->create();
    }
}