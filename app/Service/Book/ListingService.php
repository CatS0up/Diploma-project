<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Book;
use App\Service\BookListing;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ListingService implements BookListing
{
    private Book $bookModel;
    private StatsService $stats;

    public function __construct(Book $bookModel, StatsService $stats)
    {
        $this->bookModel = $bookModel;
        $this->stats = $stats;
    }

    public function stats(): array
    {
        return $this->stats->countStats();
    }

    public function latest(int $limit = 5): Collection
    {
        return $this->bookModel
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function filterBy(array $filters, int $limit = 15): LengthAwarePaginator
    {
        $query = $this->bookModel->with(self::RELATIONS);

        if ($filters['q']) {
            $phrase = "{$filters['q']}%";

            $query->where('title', 'like', $phrase)
                ->orWhere('isbn', 'like', $phrase);
        }

        if ($filters['publisher'] !== self::TYPE_ALL) {
            $query->whereHas('publisher', fn (Builder $q) => $q->where('name', $filters['publisher']));
        }

        if ($filters['genre'] !== self::TYPE_ALL) {
            $query->whereHas('genres', fn (Builder $q) => $q->where('slug', $filters['genre']));
        }

        if ($sort = $filters['sort']) {
            $sort = in_array($sort, ['asc', 'desc']) ? $sort : self::SORT_DEFAULT;

            $query->orderBy('title', $sort);
        }

        return $query->paginate($limit);
    }
}
