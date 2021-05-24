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

    public function count(): int
    {
        return $this->genreModel->count();
    }
}
