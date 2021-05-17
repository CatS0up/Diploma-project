<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Genre;
use App\Repository\GenreRepository as GenreRepositoryInterface;
use App\Repository\Pageable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Countable;

class GenreRepository implements GenreRepositoryInterface, Countable, Pageable
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

    public function allPaginated(int $limit = self::LIMIT)
    {
        return $this->genreModel->paginate($limit);
    }

    public function create(string $name): void
    {
        $this->genreModel->name = $name;
        $this->genreModel->save();
    }

    public function delete(int $id): void
    {
        $this->genreModel->find($id)->delete();
    }

    public function count(): int
    {
        return $this->genreModel->count();
    }
}
