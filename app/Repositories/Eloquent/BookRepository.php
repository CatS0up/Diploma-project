<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Repositories\BookRepository as BookRepositoryInterface;
use App\Services\Book\BookFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository implements BookRepositoryInterface
{
    private Book $book;
    private BookFilter $filter;

    public function __construct(Book $book, BookFilter $filter)
    {
        $this->book = $book;
        $this->filter = $filter;
    }

    public function filterBy(array $filters, int $limit = self::PAGE_SIZE): LengthAwarePaginator
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