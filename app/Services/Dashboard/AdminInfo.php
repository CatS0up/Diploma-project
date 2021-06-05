<?php

declare(strict_types=1);

namespace App\Services\Dashboard;

use Illuminate\Support\Collection;

class AdminInfo
{
    private Collection $stats;
    private Collection $repos;

    public function __construct(
        Collection $stats,
        Collection $repos
    ) {
        $this->stats = $stats;
        $this->repos = $repos;
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
        return $this->repos->get($repoName)->latest($limit);
    }
}
