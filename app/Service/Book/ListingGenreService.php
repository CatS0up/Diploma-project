<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Genre;
use Illuminate\Support\Collection;

class ListingGenreService
{
    private Genre $genreModel;

    public function __construct(Genre $genreModel)
    {
        $this->genreModel = $genreModel;
    }

    public function all(): Collection
    {
        return $this->genreModel->all();
    }

    public function allPaginated(int $limit = 15): Collection
    {
        return $this->genreModel->get();
    }
}
