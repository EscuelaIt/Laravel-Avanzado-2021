<?php

namespace App\Providers;

use App\Services\MockiService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MockiService::class, function ($app) {
            return new MockiService('d4867d8b-b5d5-4a48-a4ab-79131b5809b8');
        });

        // $this->app->singleton(MockiService::class, function ($app) {
        //     return new MockiService('d4867d8b-b5d5-4a48-a4ab-79131b5809b8');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading(! $this->app->isProduction());

        Carbon::setLocale(app()->getLocale());
    }
}
