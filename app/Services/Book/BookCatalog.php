<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Publisher;
use App\Services\Book\BookListing;
use App\Services\Book\Genres\GenreListing;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BookCatalog
{
    private const EXPECTED_FILTERS = ['q', 'genre', 'publisher', 'sort'];

    private BookListing $bookList;
    private GenreListing $genreList;
    private Publisher $publisherList;

    private array $filters = [];

    public function __construct(
        BookListing $bookListing,
        GenreListing $genreList,
        Publisher $publisherList
    ) {
        $this->bookList = $bookListing;
        $this->genreList = $genreList;
        $this->publisherList = $publisherList;
    }

    public function genres(): Collection
    {
        return $this->genreList->all();
    }

    public function publishers(): Collection
    {
        return $this->publisherListnig->all();
    }

    public function filteredBooks(array $filters): LengthAwarePaginator
    {
        $this->prepareFilters($filters);

        return $this->bookList->filterBy($this->filters());
    }

    public function filters(): array
    {
        return $this->filters();
    }

    private function prepareFilters(array $filters): void
    {
        $this->filters = array_map(
            function ($excpectedFiler) use ($filters) {

                if (!array_key_exists($excpectedFiler, $filters)) {
                    return $filters[$excpectedFiler] = null;
                }

                return $filters[$excpectedFiler];
            },
            self::EXPECTED_FILTERS,
        );
    }
}
