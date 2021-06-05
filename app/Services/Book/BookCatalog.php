<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use App\Repositories\PublisherRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BookCatalog
{
    private const EXPECTED_FILTERS = ['q', 'genre', 'publisher', 'sort'];
    private const DEFAULT_FILTERS = [
        'genre' => 'all',
        'publisher' => 'all',
        'sort' => 'asc'
    ];

    private BookRepository $bookRepository;
    private GenreRepository $genreRepository;
    private PublisherRepository $publisherRepository;

    private array $filters = [];

    public function __construct(
        BookRepository $bookRepository,
        GenreRepository $genreRepository,
        PublisherRepository $publisherRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->genreRepository = $genreRepository;
        $this->publisherRepository = $publisherRepository;
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

    private function prepareFilters(array $filters, array $expectedFilters): void
    {
        $expectedFilters = $this->extractExpectedFiltersNames($expectedFilters);

        foreach ($expectedFilters as $name) {

            if (!array_key_exists($name, $filters)) {
                $this->filters[$name] = self::DEFAULT_FILTERS[$name] ?? null;
            } else {
                $this->filters[$name] = $filters[$name];
            }
        }
    }

    private function extractExpectedFiltersNames(array $expectedFilters): array
    {
        return array_intersect_key($expectedFilters, self::EXPECTED_FILTERS);
    }
}
