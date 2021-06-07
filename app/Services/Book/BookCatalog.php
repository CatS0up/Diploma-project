<?php

declare(strict_types=1);

namespace App\Services\Book;

use Illuminate\Pagination\LengthAwarePaginator;

class BookCatalog
{

    private BookFilteredList $list;
    private BookStats $stats;

    public function __construct(BookFilteredList $list, BookStats $stats)
    {
        $this->list = $list;
        $this->stats = $stats;
    }

    public function allFiltered(array $filters, array $expectedFilters): LengthAwarePaginator
    {
        return $this->list
            ->setFilters($filters)
            ->qualifyFilters($expectedFilters)
            ->filter();
    }

    public function inputValues(): array
    {
        return $this->list->inputValues();
    }

    public function stats(): array
    {
        return [
            'all_amount' => $this->stats->count(),
            'best_amount' => $this->stats->countBest()
        ];
    }

    public function filters(): array
    {
        return $this->list->filters();
    }
}
