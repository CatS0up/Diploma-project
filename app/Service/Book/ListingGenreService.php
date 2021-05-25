<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Genre;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListingGenreService
{
    private Genre $genreModel;
    private GenreStatsService $stats;

    public function __construct(Genre $genreModel, GenreStatsService $stats)
    {
        $this->genreModel = $genreModel;
        $this->stats = $stats;
    }

    public function stats(): array
    {
        return $this->stats->countStats();
    }

    public function all(): Collection
    {
        return $this->genreModel->all();
    }

    public function allPaginated(int $limit = 15): LengthAwarePaginator
    {
        return $this->genreModel->paginate($limit);
    }
}
