<?php

namespace App\Providers;

use App\Interfaces\Repositories\CompanyRepositoryInterface;
use App\Repositories\CompanyRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
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
    }
}
