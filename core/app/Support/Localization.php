<?php

namespace App\Support;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Localization
{
    /**
     * Set the app localization based on the browser preferences.
     */
    public static function set() : void
    {
        if (session('locale')) {
            // Let the local session override the user settings
            return;
        }

        // Attempt to use the user settings
        $user = Auth::user();

        if ($user) {
            $locale = $user->settings
                ? $user->settings->locale
                : config('app.locale', 'en');

            App::setLocale($locale);
            return;
        }

        // Attempt to use the browser preferences
        if (array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)) {
            $browserLocale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if ($browserLocale === "en" || $browserLocale === "es") {
                App::setLocale($browserLocale);
            }
        }
    }
}
