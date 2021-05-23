<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Genre;

class GenreService
{
    private Genre $genreModel;

    public function __construct(Genre $genreModel)
    {
        $this->genreModel = $genreModel;
    }

    public function create(array $data): Genre
    {
        $this->genreModel->name = $data['name'];
        $this->genreModel->save();

        return $this->genreModel;
    }

    public function delete(int $id): bool
    {
        return $this->genreModel->firstWhere('id', $id)->delete();
    }
}
