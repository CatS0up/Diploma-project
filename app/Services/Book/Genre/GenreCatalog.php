<?php

declare(strict_types=1);

namespace App\Services\Book\Genre;

use App\Models\Genre;
use Illuminate\Pagination\LengthAwarePaginator;

class GenreCatalog
{
    private Genre $genre;

    public function __construct(Genre $genre, GenreStats $stats)
    {
        $this->genre = $genre;
        $this->stats = $stats;
    }

    public function allPaginated(int $limit = 10): LengthAwarePaginator
    {
        return $this->genre->paginate($limit);
    }

    public function stats(): array
    {
        return ['all_amount' => $this->genre->count()];
    }
}
