<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Genre;

class GenreStatsService
{
    private Genre $genreModel;

    public function __construct(Genre $genreModel)
    {
        $this->genreModel = $genreModel;
    }

    public function countStats(): array
    {
        return [
            'all_amount' => $this->allCount()
        ];
    }

    public function allCount(): int
    {
        return $this->genreModel->count();
    }
}
