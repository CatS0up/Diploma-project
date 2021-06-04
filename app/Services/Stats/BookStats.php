<?php

declare(strict_types=1);

namespace App\Services\Stats;

use Illuminate\Database\Query\Builder;

class BookStats
{
    /**
     * Class use QueryBuilder instead of Eloquent
     * because @method countBest() is hard to implementation
     * by Eloquent
     */
    private Builder $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function count(): int
    {
        return $this->builder->table('books')
    }
}
