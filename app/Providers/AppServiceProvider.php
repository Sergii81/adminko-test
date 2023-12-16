<?php

namespace App\Providers;

use App\Interfaces\ClientService\ClientServiceInterface;
use App\Interfaces\ClientService\ParseServiceInterface;
use App\Interfaces\Repositories\CompanyRepositoryInterface;
use App\Interfaces\Repositories\PositionRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\PositionRepository;
use App\Repositories\UserRepository;
use App\Services\ParseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    public function registerRepositories(): void
    {
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PositionRepositoryInterface::class, PositionRepository::class);
    }

    /**
     * @return void
     */
    public function registerServices(): void
    {
        $this->app->bind(ParseServiceInterface::class, ParseService::class);
    }
}
