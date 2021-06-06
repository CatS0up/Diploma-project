<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Support\Collection;

class BookFilterValuesProvider
{
    private Genre $genre;
    private Publisher $publisher;

    public function __construct(Genre $genre, Publisher $publisher)
    {
        $this->genre = $genre;
        $this->publisher = $publisher;
    }

    public function getPublishers(): Collection
    {
        return $this->publisher->get();
    }

    public function getGenres(): Collection
    {
        return $this->genre->get();
    }
}
