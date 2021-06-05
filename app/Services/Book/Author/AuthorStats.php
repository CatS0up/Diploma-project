<?php

declare(strict_types=1);

namespace App\Services\Book\Author;

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
