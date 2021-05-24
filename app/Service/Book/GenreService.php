<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Genre;

class GenreService
{
    private const FIELD_NAMES = ['genre'];

    private Genre $genreModel;

    public function __construct(Genre $genreModel)
    {
        $this->genreModel = $genreModel;
    }

    public function create(array $data): Genre
    {
        return $this->genreModel->firstOrCreate(['name' => $data['genre']]);
    }

    public function update(array $data): Genre
    {
        return $this->genreModel->firstOrCreate(['name' => $data['genre']]);
    }

    public function delete(int $id): bool
    {
        return $this->genreModel->firstWhere('id', $id)->delete();
    }

    public function acceptableFields(): array
    {
        return self::FIELD_NAMES;
    }
}
