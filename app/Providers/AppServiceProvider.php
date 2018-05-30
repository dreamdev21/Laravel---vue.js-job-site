<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use App\Models\Country;
use Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::serializeUsing(function ($carbon) {
            return $carbon->toIso8601String();
        });
        if (!$this->app->runningInConsole()) {
            \View::share('countries', Country::all());
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // ignore passport migrations
        Passport::ignoreMigrations();
        // if (app()->environment() === 'local') {
        //     $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        // }
    }
}
