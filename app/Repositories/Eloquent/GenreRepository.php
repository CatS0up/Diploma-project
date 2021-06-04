<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Genre;
use App\Repositories\GenreRepository as GenreRepositoryInterface;
use Illuminate\Support\Collection;

class GenreRepository implements GenreRepositoryInterface
{
    private Genre $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function all(): Collection
    {
        return $this->genre->all();
    }
}
