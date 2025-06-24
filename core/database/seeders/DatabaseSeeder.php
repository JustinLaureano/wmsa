<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Part;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Part::factory(5)->create();

        Location::factory(10)->create();

        $this->call([
            TeammateSeeder::class,
            UserSeeder::class,
            UserSettingSeeder::class,
            ConversationSeeder::class,
            SortListSeeder::class,
            MaterialContainerSeeder::class,
            ContainerLocationSeeder::class,
            IrmChemicalLocationSeeder::class,
            MaterialRequestSeeder::class,
            DeliveryDocumentSeeder::class,
        ]);
    }
}
