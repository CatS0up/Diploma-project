<?php

namespace App\Providers;

use App\Repository\BookRepository;
use App\Repository\Eloquent\BookRepository as EloquentBookRepository;
use Illuminate\Support\ServiceProvider;

class BooksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BookRepository::class, EloquentBookRepository::class);
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
