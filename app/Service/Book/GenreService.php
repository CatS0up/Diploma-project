<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Genre;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GenreService
{
    private const FIELD_NAMES = ['genres'];

    private Genre $genreModel;

    public function __construct(Genre $genreModel, GenreStatsService $stats)
    {
        $this->genreModel = $genreModel;
        $this->stats = $stats;
    }

    public function createSingle(array $data): Genre
    {
        return $this->genreModel->firstOrCreate(
            [
                'name' => $data['name'],
                'slug' => Str::slug($data['name'])
            ]
        );
    }

    public function createMany(array $data): Collection
    {
        $genres = preg_split('/ ?[,]{1} ?/', $data['genres']);
        $genres = array_unique($genres);

        $genreModels = [];
        foreach ($genres as $genre) {
            $genreModels[] = $this->createSingle(['name' => $genre]);
        }

        return collect(array_unique($genreModels));
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
