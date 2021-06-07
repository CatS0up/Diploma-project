<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Collection;

class BookDetailsService
{
    private Genre $genre;
    private Author $author;

    public function __construct(Genre $genre, Author $author)
    {
        $this->genre = $genre;
        $this->author = $author;
    }

    public function addGenres(Book $book, string $list)
    {
        $genres = $this->genresPrepare($list);

        $existing = $book->genres()->get();

        $book->genres()->saveMany($genres->diffAssoc($existing)->all());
    }

    public function addAuthors(Book $book, string $list)
    {
        $authors = $this->authorsPrepare($list);

        $existing = $book->authors()->get();

        $book->authors()->saveMany($authors->diffAssoc($existing)->all());
    }

    private function genresPrepare(string $genres): Collection
    {
        $genres = preg_split('/ *[,|.] */', $genres);

        $genres = $this->extractUnique($genres);

        $models = [];
        foreach ($genres as $genre) {
            $models[] = $this->genre
                ->firstOrCreate(['name' => $genre]);
        }

        return collect($models);
    }

    private function authorsPrepare(string $authors): Collection
    {
        $authors = preg_split('/ *[,|.] */', $authors);

        $authors = $this->extractUnique($authors);

        $models = [];
        foreach ($authors as $author) {
            $components = preg_split('/[ ]+/', $author);

            $models[] = $this->author
                ->firstOrCreate([
                    'firstname' => $components[0],
                    'lastname' => $components[1] ?? '(BRAK)'
                ]);
        }

        return collect($models);
    }

    private function extractUnique(array $fields): array
    {
        return array_unique(array_map(
            fn ($field) => strtolower($field),
            $fields
        ));
    }
}
