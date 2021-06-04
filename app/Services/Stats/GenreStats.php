<?php

declare(strict_types=1);

namespace App\Services\Stats;

use App\Models\Genre;

class GenreStats
{
    private Genre $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function count(): int
    {
        return $this->genre->count();
    }
}
