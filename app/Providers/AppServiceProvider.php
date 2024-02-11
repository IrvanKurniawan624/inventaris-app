<?php

namespace App\Providers;

use App\Repositories\Kategori\KategoriRepository;
use App\Repositories\Kategori\KategoriRepositoryImplement;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\SupplierRepositoryImplement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Apps
        $this->app->bind(KategoriRepository::class, KategoriRepositoryImplement::class);
        $this->app->bind(SupplierRepository::class, SupplierRepositoryImplement::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
