<?php

declare(strict_types=1);

namespace App\Services\Dashboard;

use Illuminate\Support\Collection;

class AdminInfoService
{
    private Collection $stats;
    private Collection $models;

    public function __construct(
        Collection $stats,
        Collection $models
    ) {
        $this->stats = $stats;
        $this->models = $models;
    }

    public function countStats(): array
    {
        return [
            'books' => $this->stats->get('book')->count(),
            'authors' => $this->stats->get('author')->count(),
            'genres' => $this->stats->get('genre')->count(),
            'publishers' => $this->stats->get('publisher')->count(),
            'users' => $this->stats->get('user')->count(),
            'privilaged_users' => $this->stats->get('user')->privilagedCount()
        ];
    }

    public function getLatest(string $repoName, int $limit = 5): ?Collection
    {
        return $this->models->get($repoName)->latest()->take($limit)->get();
    }
}
