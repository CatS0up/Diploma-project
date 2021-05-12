<?php

namespace App\Providers;

use App\Repository\Eloquent\PublisherRepository as EloquentPublisherRepository;
use App\Repository\PublisherRepository;
use Illuminate\Support\ServiceProvider;

class PublishersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            PublisherRepository::class,
            EloquentPublisherRepository::class
        );
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
