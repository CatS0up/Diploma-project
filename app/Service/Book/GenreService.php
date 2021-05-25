<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Genre;

class GenreService
{
    private const FIELD_NAMES = ['genre'];

    private Genre $genreModel;
    private GenreStatsService $stats;

    public function __construct(Genre $genreModel, GenreStatsService $stats)
    {
        $this->genreModel = $genreModel;
        $this->stats = $stats;
    }

    public function create(array $data): Genre
    {
        return $this->genreModel->firstOrCreate(['name' => $data['name']]);
    }

    public function update(array $data): Genre
    {
        return $this->genreModel->firstOrCreate(['name' => $data['name']]);
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
