<?php

namespace App\Providers;

use App\Services\Dashboard\DashboardStats;
use Illuminate\Support\ServiceProvider;

class DashboardStatsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
