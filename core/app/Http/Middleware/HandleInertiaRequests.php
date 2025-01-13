<?php

namespace App\Http\Middleware;

use App\Http\Resources\Auth\UserProfileResource;
use App\Support\Localization;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        Localization::set();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? new UserProfileResource($request->user()) : null,
                'auth_method' => session('auth_method')
            ],

            'lang' => __('frontend'),

            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            }
        ];
    }
}
