<?php

namespace Database\Seeders;

use App\Domain\Production\Actions\CreateMaterialRequestAction;
use App\Domain\Production\Enums\RequestStatusEnum;
use Database\Factories\MaterialRequestFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Lottery;

class MaterialRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requestedAt = now()->subDays(7);
        $now = now();

        while ($requestedAt->lt($now)) {

            $requestStatus = RequestStatusEnum::OPEN->value;

            if ($requestedAt->copy()->diffInMinutes($now) > 90) {
                $isClosed = Lottery::odds(8, 10)->choose();

                $requestStatus = $isClosed
                    ? RequestStatusEnum::COMPLETED->value
                    : RequestStatusEnum::CANCELLED->value;
            }

            if ($requestedAt->copy()->diffInMinutes($now) <= 90 && $requestedAt->copy()->diffInMinutes($now) > 25) {
                $isNotOpen = Lottery::odds(2, 10)->choose();
                $isClosed = Lottery::odds(8, 10)->choose();

                if ($isNotOpen) {
                    $requestStatus = $isClosed
                        ? RequestStatusEnum::COMPLETED->value
                        : RequestStatusEnum::CANCELLED->value;
                }
            }

            $actionData = MaterialRequestFactory::makeActionData($requestedAt, $requestStatus);

            (new CreateMaterialRequestAction())->handle($actionData);

            $minutes = rand(5, 20);

            $requestedAt->addMinutes($minutes);
        }
    }
}
