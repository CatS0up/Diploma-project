<?php

namespace App\Providers;

use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
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

                $repos = collect([
                    'users' => $app->make(UserRepository::class),
                    'books' => $app->make(BookRepository::class)
                ]);

                return new AdminInfo($stats, $repos);
            }
        );
    }
}
