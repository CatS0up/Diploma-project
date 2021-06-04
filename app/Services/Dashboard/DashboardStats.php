<?php

declare(strict_types=1);

namespace App\Services\Dashboard;

use Illuminate\Support\Collection;

class DashboardStats
{
    private Collection $stats;

    public function __construct(
        Collection $stats,
    ) {
        $this->stats = $stats;
    }

    public function allStats(): array
    {
        return [];
    }
}
