<?php

namespace App\Providers;

use App\Support\Eloquent\Filter\Filter;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Filter::class, static function () {
            return new Filter;
        });
    }

}
