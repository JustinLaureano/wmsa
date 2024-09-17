<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocalization
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return void
    */
    public function handle(Request $request, Closure $next)
    {
        if (session('locale')) {
            App::setLocale( session('locale') );

            return $next($request);
        }

        if (array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)) {
            $browserLocale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if ($browserLocale === "en" || $browserLocale === "es") {
                App::setLocale($browserLocale);
            }
        }

        return $next($request);
    }
}
