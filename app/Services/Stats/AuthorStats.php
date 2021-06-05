<?php

declare(strict_types=1);

namespace App\Services\Stats;

use App\Models\Author;

class AuthorStats
{
    private Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function count(): int
    {
        return $this->author->count();
    }
}
