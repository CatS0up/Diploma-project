<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookFilter
{
    private Book $query;

    public function __construct(Book $query)
    {
        $this->query = $query;
    }

    public function setPhrase(string $phrase): BookFilter
    {
        $phrase = "$phrase%";

        $this->query
            ->where('title', 'like', $phrase)
            ->orWhere('isbn', 'like', $phrase);

        return $this;
    }

    public function setPublisher(string $publisherName): BookFilter
    {
        $this->query
            ->whereHas(
                'publisher',
                fn ($q) => $q->where('name', $publisherName)
            );

        return $this;
    }

    public function setGenre(string $genreName): BookFilter
    {
        $this->query
            ->whereHas(
                'genres',
                fn ($q) => $q->where('name', $genreName)
            );

        return $this;
    }

    public function getPaginated(int $limit = 10): LengthAwarePaginator
    {
        return $this->query->paginate($limit);
    }
}
