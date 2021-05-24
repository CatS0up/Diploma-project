<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Collection;

class DashboardService
{
    private Collection $statsServices;

    public function __construct(Collection $statsServices)
    {
        $this->statsServices = $statsServices;
    }

    public function getStats(): array
    {
        return [
            'users_amount' => $this->statsServices->get('users_stats')->allCount(),
            'privilaged_amount' => $this->statsServices->get('users_stats')->privilagedCount(),
            'books_amount' => $this->statsServices->get('books_stats')->allCount(),
            'genres_amount' => $this->statsServices->get('genres_stats')->allCount(),
            'authors_amount' => $this->statsServices->get('authors_stats')->allCount(),
            'publishers_amount' => $this->statsServices->get('publishers_stats')->allCount(),
        ];
    }
}
