<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Genre;
use App\Models\Publisher;
use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use App\Repositories\PublisherRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BookCatalog
{

    private BookFilteredList $bookList;

    public function __construct(BookFilteredList $bookList)
    {
        $this->bookList = $bookList;
        $this->genre = $genre;
        $this->publisher = $publisher;
    }

    public function genres(): Collection
    {
        return $this->genreRepository->all();
    }

    public function publishers(): Collection
    {
        return $this->publisherRepository->all();
    }

    public function filteredBooks(
        array $filters,
        array $expectedFilters = self::EXPECTED_FILTERS
    ): LengthAwarePaginator {

        $this->prepareFilters($filters, $expectedFilters);

        return $this->bookRepository
            ->filterBy($this->filters())
            ->appends($this->filters);
    }

    public function filters(): array
    {
        return $this->filters;
    }
}
