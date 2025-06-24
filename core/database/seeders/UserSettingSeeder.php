<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Database\Seeders\Traits\Timestamps;
use Database\Seeders\Traits\Uuid;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
{
    use Timestamps, Uuid;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()
            ->whereHas('teammate')
            ->with('teammate')
            ->get();

        foreach ($users as $user) {
            $spanishUsers = ['Gomez', 'Lopez', 'Sanchez'];

            $locale = in_array($user->teammate->last_name, $spanishUsers)
                ? 'es'
                : 'en';

            UserSetting::create(array_merge(
                [
                    'user_uuid' => $user->uuid,
                    'locale' => $locale,
                ],
                $this->getUuid(),
                $this->getTimestamps()
            ));
        }
    }
}
