<?php

namespace App\Repositories;

use App\Models\UserSetting;
use Illuminate\Support\Facades\Auth;

class UserSettingRepository
{
    public function updateLocale(string $locale) : void
    {
        UserSetting::query()
            ->where('user_uuid', Auth::user()->uuid)
            ->update(['locale' => $locale]);
    }
}
