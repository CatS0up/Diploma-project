<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookListing
{
    private BookFilter $filter;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function filterBy(array $filters, int $limit = 10): LengthAwarePaginator
    {
        if (isset($filters['q']))
            $this->filter->setPhrase($filters['q']);

        if ($publisher = $filters['publisher'] ?? 'all')
            $this->filter->setPublisher($publisher);

        if ($genre = $filters['genre'] ?? 'all')
            $this->filter->setGenre($genre);

        return $this->filter->getPaginated($limit);
    }
}
