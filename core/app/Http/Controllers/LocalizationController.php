<?php

namespace App\Http\Controllers;

use App\Repositories\UserSettingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LocalizationController extends Controller
{
    /**
     * Set the app locale for the session.
     */
    public function set(Request $request): JsonResponse
    {
        $locale = $request->input('locale');

        if ($locale === "en" || $locale === "es") {
            App::setLocale($locale);

            session(["locale" => $locale]);

            if (Auth::user()) {
                (new UserSettingRepository())->updateLocale($locale);
            }
        }

        return response()
            ->json([
                'lang' => __('frontend')
            ]);
    }
}
