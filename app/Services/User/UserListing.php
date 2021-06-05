<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Repositories\UserRepository;
use App\Services\Stats\UserStats;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserListing
{
    private const EXPECTED_FILTERS = ['q', 'sort', 'sort_by'];
    private const DEFAULT_FILTERS = [
        'sort_by' => 'id',
        'sort' => 'asc'
    ];

    private UserRepository $userReposiotry;
    private UserStats $stats;

    private array $filters = [];

    public function __construct(UserRepository $userReposiotry, UserStats $stats)
    {
        $this->userReposiotry = $userReposiotry;
        $this->stats = $stats;
    }

    public function allPrivilaged(): ?Collection
    {
        return $this->userReposiotry->allPrivilaged();
    }

    public function filteredUsers(
        array $filters,
        array $expectedFilters = self::EXPECTED_FILTERS
    ): LengthAwarePaginator {

        $this->prepareFilters($filters, $expectedFilters);

        return $this->userReposiotry
            ->filterBy($this->filters())
            ->appends($this->filters);
    }

    public function stats(): array
    {
        return [
            'all_count' => $this->stats->count(),
            'privilaged_count' => $this->stats->privilagedCount(),
        ];
    }

    public function filters(): array
    {
        return $this->filters;
    }

    private function prepareFilters(array $filters, array $expectedFilters): void
    {
        $expectedFilters = $this->extractExpectedFiltersNames($expectedFilters);

        foreach ($expectedFilters as $name) {

            if (!array_key_exists($name, $filters)) {
                $this->filters[$name] = self::DEFAULT_FILTERS[$name] ?? null;
            } else {
                $this->filters[$name] = $filters[$name];
            }
        }
    }

    private function extractExpectedFiltersNames(array $expectedFilters): array
    {
        return array_intersect_key($expectedFilters, self::EXPECTED_FILTERS);
    }
}
