<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Services\Listing\FilteredList;
use Illuminate\Pagination\LengthAwarePaginator;

class BookFilteredList extends FilteredList
{
    private const ACCEPTABLE_FILTERS = ['q', 'genre', 'publisher', 'sort'];
    private const DEFAULT_FILTERS = [
        'genre' => 'all',
        'publisher' => 'all',
        'sort' => 'asc'
    ];

    private BookFilter $filter;
    private BookFilterValuesProvider $values;

    public function __construct(BookFilter $filter, BookFilterValuesProvider $values)
    {
        $this->acceptableFilters = self::ACCEPTABLE_FILTERS;
        $this->defaultFiletrs = self::DEFAULT_FILTERS;

        $this->filter = $filter;
        $this->values = $values;
    }

    public function inputValues(): array
    {
        return [
            'genres' => $this->values->getGenres(),
            'publishers' => $this->values->getPublishers()
        ];
    }

    public function filter(): LengthAwarePaginator
    {
        $this->prepareFilters();

        if (isset($this->filters['q']))
            $this->filter->setPhrase($this->filters['q']);

        if (isset($filters['genre']) && $filters['genre'] !== 'all')
            $this->filter->setGenre($this->filters['genre']);

        if (isset($filters['publisher']) && $filters['publisher'] !== 'all')
            $this->filter->setPublisher($this->filters['publisher']);


        return $this->filter
            ->setSort('title', $this->filters['sort'] ?? 'asc')
            ->getPaginated();
    }
}
