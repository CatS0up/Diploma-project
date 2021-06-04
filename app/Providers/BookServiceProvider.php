<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use App\Repositories\PublisherRepository;
use App\Repositories\Eloquent\BookRepository as EloquentBookRepository;
use App\Repositories\Eloquent\GenreRepository as EloquentGenreRepository;
use App\Repositories\Eloquent\PublisherRepository as EloquentPublisherRepository;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            BookRepository::class,
            EloquentBookRepository::class
        );

        $this->app->singleton(
            GenreRepository::class,
            EloquentGenreRepository::class
        );

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
