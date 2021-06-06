<?php

declare(strict_types=1);

namespace App\Services\User;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserCatalog
{

    private UserFilteredList $list;
    private UserStats $stats;

    public function __construct(UserFilteredList $list, UserStats $stats)
    {
        $this->list = $list;
        $this->stats = $stats;
    }

    public function allFiltered(array $filters, array $expectedFilters): LengthAwarePaginator
    {
        return $this->list
            ->setFilters($filters)
            ->qualifyFilters($expectedFilters)
            ->filter();
    }

    public function allPrivilaged(): Collection
    {
        return $this->user->privilaged()->get();
    }

    public function stats(): array
    {
        return [
            'all_amount' => $this->stats->count(),
            'privilaged_amount' => 0
        ];
    }

    public function filters(): array
    {
        return $this->list->filters();
    }
}
