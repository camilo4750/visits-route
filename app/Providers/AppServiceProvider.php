<?php

namespace App\Providers;

use App\Interfaces\Repositories\Visit\VisitRepositoryInterface;
use App\Interfaces\Services\Visit\VisitServiceInterface;
use App\Repositories\Visit\VisitRepository;
use App\Services\Visit\VisitService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VisitServiceInterface::class, VisitService::class);
        $this->app->bind(VisitRepositoryInterface::class, VisitRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
