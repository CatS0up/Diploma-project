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

    public function countStats(): array
    {
        return [
            'all_amount' => $this->allCount()
        ];
    }

    public function allCount(): int
    {
        return $this->authorModel->count();
    }
}
