<?php

namespace App\Providers;

use App\View\Components\Rating;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RatingComponentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('rate', Rating::class);
    }
}
