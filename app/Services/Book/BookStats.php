<?php

declare(strict_types=1);

namespace App\Services\Book;

use Illuminate\Database\DatabaseManager;

class BookStats
{
    /**
     * Class use QueryBuilder instead of Eloquent
     * because @method countBest() is hard to implementation
     * by Eloquent
     */
    private DatabaseManager $builder;

    public function __construct(DatabaseManager $builder)
    {
        $this->builder = $builder;
    }

    public function count(): int
    {
        return $this->builder->table('books')->count();
    }

    public function countBest(): int
    {
        $subquery = $this->builder
            ->table('reviews')
            ->selectRaw('AVG(rate) as avg_rate')
            ->groupBy('book_id')
            ->havingRaw('avg_rate > 4')
            ->toSql();

        return $this->builder
            ->table(
                $this->builder
                    ->raw("({$subquery}) as sub")
            )
            ->count();
    }
}
