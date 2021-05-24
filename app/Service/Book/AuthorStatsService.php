<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Author;

class AuthorStatsService
{
    private Author $authorModel;

    public function __construct(Author $authorModel)
    {
        $this->authorModel = $authorModel;
    }

    public function count(): int
    {
        return $this->authorModel->count();
    }
}
