<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use App\Services\Dashboard\AdminInfo;
use App\Services\Book\Author\AuthorStats;
use App\Services\Book\BookStats;
use App\Services\Book\Genre\GenreStats;
use App\Services\Book\Publisher\PublisherStats;
use App\Services\User\UserStats;
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
        $this->app->singleton(
            AdminInfo::class,
            function ($app) {
                $stats = collect(
                    [
                        'book' => $app->make(BookStats::class),
                        'author' => $app->make(AuthorStats::class),
                        'genre' => $app->make(GenreStats::class),
                        'publisher' => $app->make(PublisherStats::class),
                        'user' => $app->make(UserStats::class)
                    ]
                );

                $models = collect([
                    'users' => $app->make(User::class),
                    'books' => $app->make(Book::class)
                ]);

                return new AdminInfo($stats, $models);
            }
        );
    }
}
