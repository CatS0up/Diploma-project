<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Collection;

class DashboardService
{
    private Collection $stats;
    private Collection $listings;

    public function __construct(Collection $stats, Collection $listings)
    {
        $this->stats = $stats;
        $this->listings = $listings;
    }

    public function getStats(): array
    {
        return [
            'users_amount' => $this->stats->get('users_stats')->allCount(),
            'privilaged_amount' => $this->stats->get('users_stats')->privilagedCount(),
            'books_amount' => $this->stats->get('books_stats')->allCount(),
            'genres_amount' => $this->stats->get('genres_stats')->allCount(),
            'authors_amount' => $this->stats->get('authors_stats')->allCount(),
            'publishers_amount' => $this->stats->get('publishers_stats')->allCount(),
        ];
    }

    public function getLatest(): array
    {
        return [
            'users' => $this->listings->get('user_listing')->latest(5),
            'books' => $this->listings->get('book_listing')->latest(5),
        ];
    }
}
