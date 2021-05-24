<?php

namespace App\Providers;

use App\Service\Book\AuthorStatsService;
use App\Service\Book\GenreStatsService;
use App\Service\Book\PublisherStatsService;
use App\Service\Book\StatsService as BookStatsService;
use App\Service\DashboardService;
use App\Service\User\StatsService;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
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
        $this->app->bind(
            DashboardService::class,
            function ($app) {
                $statsCollection = collect([
                    'users_stats' => $app->make(StatsService::class),
                    'books_stats' => $app->make(BookStatsService::class),
                    'genres_stats' => $app->make(GenreStatsService::class),
                    'authors_stats' => $app->make(AuthorStatsService::class),
                    'publishers_stats' => $app->make(PublisherStatsService::class),
                ]);

                return new DashboardService($statsCollection);
            }
        );
    }
}
