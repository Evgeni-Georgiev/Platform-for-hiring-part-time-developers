<?php

namespace App\Providers;

use App\Services\Contracts\IDeveloperService;
use App\Services\Contracts\IHireService;
use App\Services\DeveloperService;
use App\Services\HireService;
use Illuminate\Http\Resources\Json\JsonResource;
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
        if (!$this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }

        $this->app->scoped(IDeveloperService::class,DeveloperService::class);
        $this->app->scoped(IHireService::class,HireService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Remove the wrapping of JSON result
        JsonResource::withoutWrapping();
    }
}
