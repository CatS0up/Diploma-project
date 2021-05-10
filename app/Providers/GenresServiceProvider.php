<?php

namespace App\Providers;

use App\Repository\Eloquent\GenreRepository as EloquentGenreRepository;
use App\Repository\GenreRepository;
use Illuminate\Support\ServiceProvider;

class GenresServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            GenreRepository::class,
            EloquentGenreRepository::class
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
