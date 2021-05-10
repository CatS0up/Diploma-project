<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Genre;
use App\Repository\GenreRepository as GenreRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class GenreRepository implements GenreRepositoryInterface
{
    private Genre $genreModel;

    public function __construct(Genre $genreModel)
    {
        $this->genreModel = $genreModel;
    }

    public function all(): Collection
    {
        return $this->genreModel->get();
    }

    public function allPaginated(int $limit = 15): Paginator
    {
        return $this->genreModel->paginate($limit);
    }
}
