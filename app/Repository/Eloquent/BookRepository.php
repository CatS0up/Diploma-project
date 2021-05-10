<?php

declare(strict_types=1);

use App\Models\Book;
use App\Repository\BookRepository as BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    private Book $bookModel;

    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function create(array $data): void
    {
    }
}
