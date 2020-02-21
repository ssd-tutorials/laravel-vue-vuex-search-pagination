<?php

namespace App\Providers;

use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Contracts\ProductRepositoryContract;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
    }
}
