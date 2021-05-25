<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Publisher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListingPublisherService
{
    private Publisher $publisherModel;
    private PublisherStatsService $stats;

    public function __construct(Publisher $publisherModel, PublisherStatsService $stats)
    {
        $this->publisherModel = $publisherModel;
        $this->stats = $stats;
    }

    public function stats(): array
    {
        return $this->stats->countStats();
    }

    public function all(): Collection
    {
        return $this->publisherModel->all();
    }

    public function allPaginated(int $limit = 15): LengthAwarePaginator
    {
        return $this->publisherModel->paginate($limit);
    }
}
