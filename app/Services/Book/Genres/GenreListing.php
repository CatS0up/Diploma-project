<?php

declare(strict_types=1);

namespace App\Services\Book\Genres;

use App\Models\Genre;
use Illuminate\Support\Collection;

class GenreListing
{
    private Genre $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function all(): Collection
    {
        return $this->genre->get();
    }
}
