<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        }

        return response()
            ->json([
                'lang' => __('frontend')
            ]);
    }
}
