<?php

namespace App\Support;

use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Set the app localization based on the browser preferences.
     */
    public static function set() : void
    {
        if (array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)) {
            $browserLocale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if ($browserLocale === "en" || $browserLocale === "es") {
                App::setLocale($browserLocale);
            }
        }
    }
}
