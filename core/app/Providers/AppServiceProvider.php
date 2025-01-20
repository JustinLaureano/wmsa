<?php

namespace App\Providers;

use App\Domain\Auth\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Implicitly grant "Super Admin" role all permissions
        Gate::before(function ($user, $ability) {
            return $user->hasRole(RoleEnum::SUPER_ADMIN->value) ? true : null;
        });

        Relation::morphMap([
            'teammate' => 'App\Models\Teammate',
            'user' => 'App\Models\User',
        ]);

        JsonResource::withoutWrapping();
    }
}
