<?php

namespace App\Providers;

use App\Domain\Auth\Enums\RoleEnum;
use App\Services\SearchService;
use App\Repositories\ViewSearchIrmChemicalRepository;
use App\Repositories\ViewSearchMaterialRepository;
use App\Repositories\ViewSearchMaterialContainerRepository;
use App\Repositories\ViewSearchMaterialRequestRepository;
use App\Repositories\ViewSearchSortListRepository;
use App\Repositories\ViewSearchStorageLocationRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SearchService::class, function ($app) {
            return new SearchService(
                irmChemicalRepository: $app->make(ViewSearchIrmChemicalRepository::class),
                materialRepository: $app->make(ViewSearchMaterialRepository::class),
                materialContainerRepository: $app->make(ViewSearchMaterialContainerRepository::class),
                materialRequestRepository: $app->make(ViewSearchMaterialRequestRepository::class),
                sortListRepository: $app->make(ViewSearchSortListRepository::class),
                storageLocationRepository: $app->make(ViewSearchStorageLocationRepository::class),
            );
        });
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

        // Model::automaticallyEagerLoadRelationships();
    }
}
