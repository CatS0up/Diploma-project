<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListingAuthorService
{
    private Author $authorModel;
    private AuthorStatsService $stats;

    public function __construct(Author $authorModel, AuthorStatsService $stats)
    {
        $this->authorModel = $authorModel;
        $this->stats = $stats;
    }

    public function stats(): array
    {
        return $this->stats->countStats();
    }

    public function allPaginated(int $limit = 15): LengthAwarePaginator
    {
        return $this->authorModel->paginate($limit);
    }
}
