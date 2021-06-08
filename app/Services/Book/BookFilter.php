<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class BookFilter
{
    private Builder $query;

    public function __construct(Book $book)
    {
        $this->book = $book;

        $this->query = $this->book->with(['authors', 'genres', 'reviews']);
    }

    public function setOwner(int $userId): BookFilter
    {
        $this->query->whereHas(
            'users',
            fn (Builder $q) => $q->where('id', $userId)
        );

        return $this;
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

    public function setSort(string $by, string $direction): BookFilter
    {
        $this->query->orderBy($by, $direction);

        return $this;
    }

    public function getPaginated(int $limit = 10): LengthAwarePaginator
    {
        return $this->query->paginate($limit);
    }
}
