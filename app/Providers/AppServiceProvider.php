<?php

namespace App\Providers;

use App\Models\Organization;
use Laravel\Cashier\Cashier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Cashier::useCustomerModel(Organization::class);       
    }
}
