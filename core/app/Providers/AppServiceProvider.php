<?php

namespace App\Providers;

use App\Domain\Auth\Enums\RoleEnum;
use App\Domain\Materials\Services\MaterialContainerRoutingService;
use App\Repositories\ContainerLocationRepository;
use App\Services\SearchService;
use App\Repositories\MaterialContainerMovementRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\MaterialRoutingRepository;
use App\Repositories\SortListRepository;
use App\Repositories\SortStorageLocationRepository;
use App\Repositories\StorageLocationRepository;
use App\Repositories\ViewSearchIrmChemicalRepository;
use App\Repositories\ViewSearchMachineRepository;
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
                machineRepository: $app->make(ViewSearchMachineRepository::class),
                materialRepository: $app->make(ViewSearchMaterialRepository::class),
                materialContainerRepository: $app->make(ViewSearchMaterialContainerRepository::class),
                materialRequestRepository: $app->make(ViewSearchMaterialRequestRepository::class),
                sortListRepository: $app->make(ViewSearchSortListRepository::class),
                storageLocationRepository: $app->make(ViewSearchStorageLocationRepository::class),
            );
        });

        $this->app->bind(MaterialContainerRoutingService::class, function ($app) {
            return new MaterialContainerRoutingService(
                containerLocationRepository: $app->make(ContainerLocationRepository::class),
                materialRepository: $app->make(MaterialRepository::class),
                materialContainerMovementRepository: $app->make(MaterialContainerMovementRepository::class),
                materialRoutingRepository: $app->make(MaterialRoutingRepository::class),
                sortListRepository: $app->make(SortListRepository::class),
                sortStorageLocationRepository: $app->make(SortStorageLocationRepository::class),
                storageLocationRepository: $app->make(StorageLocationRepository::class),
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
