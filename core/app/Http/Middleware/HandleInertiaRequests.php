<?php

namespace App\Http\Middleware;

use App\Http\Resources\Auth\UserProfileResource;
use App\Http\Resources\Locations\BuildingResource;
use App\Models\User;
use App\Repositories\BuildingRepository;
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
                'auth_method' => session('auth_method'),
                'building' => $this->getBuilding(),
                'building_id' => session('building_id'),
                'user' => $request->user() ? new UserProfileResource($request->user()) : null,
                'permissions' => $request->user()
                    ? $this->getPermissions($request->user())
                    : [],
                'roles' => $request->user()
                    ? $request->user()->getRoleNames()->toArray()
                    : [],
            ],

            'lang' => __('frontend'),

            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            }
        ];
    }

    protected function getBuilding() : BuildingResource|null
    {
        return session('building_id')
            ? new BuildingResource(
                (new BuildingRepository)->find(session('building_id'))
            )
            : null;
    }

    protected function getPermissions(User $user) : array
    {
        return array_merge(
            $user->roles
                ->pluck('permissions')
                ->flatten()
                ->pluck('name')
                ->toArray(),
            $user->getDirectPermissions()
                ->pluck('name')
                ->toArray()
        );
    }
}
