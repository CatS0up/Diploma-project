<?php

declare(strict_types=1);

namespace App\Services\Book\Author;

use App\Models\Author;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorCatalog
{
    private Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function allPaginated(int $limit = 10): LengthAwarePaginator
    {
        return $this->author->paginate($limit);
    }

    public function stats(): array
    {
        return ['all_amount' => $this->author->count()];
    }
}
