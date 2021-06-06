<?php

declare(strict_types=1);

namespace App\Services\Book\Author;

use App\Models\Author;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorCatalog
{
    private Author $genre;

    public function __construct(Author $genre, AuthorStats $stats)
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
