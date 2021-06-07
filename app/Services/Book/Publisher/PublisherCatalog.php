<?php

declare(strict_types=1);

namespace App\Services\Book\Publisher;

use App\Models\Publisher;
use App\Services\Book\Publisher\PublisherStats;
use Illuminate\Pagination\LengthAwarePaginator;

class PublisherCatalog
{
    private Publisher $genre;

    public function __construct(Publisher $genre, PublisherStats $stats)
    {
        $this->genre = $genre;
        $this->stats = $stats;
    }

    public function allPaginated(int $limit = 10): LengthAwarePaginator
    {
        return $this->genre->paginate($limit);
    }

    public function stats(): array
    {
        return ['all_amount' => $this->genre->count()];
    }
}
