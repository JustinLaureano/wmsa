<?php

namespace Database\Seeders;

use App\Notifications\Support\NotificationTypeEnum;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class NotificationPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRepository = new UserRepository();

        // TODO: seed correctly

        $itAdmin = $userRepository->findBy('teammate_clock_number', '2360');
        $itAdminEs = $userRepository->findBy('teammate_clock_number', '13595');

        $itAdmin->notificationPreferences()->create([
            'notification_type' => NotificationTypeEnum::SORT_LIST_MATERIAL_ADDED->value,
            'email_enabled' => true,
        ]);

        $itAdminEs->notificationPreferences()->create([
            'notification_type' => NotificationTypeEnum::SORT_LIST_MATERIAL_ADDED->value,
            'email_enabled' => true,
        ]);
    }
}
