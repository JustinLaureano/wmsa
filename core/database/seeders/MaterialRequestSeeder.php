<?php

namespace Database\Seeders;

use App\Domain\Production\Actions\CreateMaterialRequestAction;
use Database\Factories\MaterialRequestFactory;
use Illuminate\Database\Seeder;

class MaterialRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
            $actionData = MaterialRequestFactory::makeActionData();

            (new CreateMaterialRequestAction())->handle($actionData);
        }
    }
}
