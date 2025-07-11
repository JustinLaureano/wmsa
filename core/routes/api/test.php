<?php

use App\Domain\Locations\Enums\BuildingIdEnum;
use App\Domain\Materials\Services\MaterialContainerRoutingService;
use App\Http\Resources\Auth\UserDetailResource;
use App\Http\Resources\Auth\UserProfileCollection;
use App\Http\Resources\Materials\SafetyStockReportResource;
use App\Models\User;
use App\Repositories\SafetyStockRepository;
use App\Services\SearchService;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/users', function () {
    return new UserProfileCollection(User::get());
});

Route::get('/user/{cn}', function (string $cn) {
    return new UserDetailResource(User::where('teammate_clock_number', $cn)->first());
});

Route::get('/safety-stock', function () {
    $report = (new SafetyStockRepository())->getSafetyStockReportPaginated();
    // $report = (new SafetyStockRepository())->getSafetyStockReport();
    return SafetyStockReportResource::collection($report);
});

Route::get('/sort-list-material-added', function () {
    $sortList = App\Models\SortList::find(1);
    App\Notifications\Support\NotificationDispatcher::sendSortListMaterialAddedNotification($sortList);
});

Route::get('/site-search', function (Request $request) {
    $query = $request->query('search', '');
    $results = app(SearchService::class)->search($query);

    return response()->json($results);
});

Route::get(
    '/locations/available/{materialContainer:uuid}',
    function (App\Models\MaterialContainer $materialContainer) {

        $routingService = app(MaterialContainerRoutingService::class);

        $storageLocations = $routingService
            ->getNextDestination($materialContainer, BuildingIdEnum::PLANT_2->value);

        return response()->json($storageLocations);
    }
)->name('locations.available');