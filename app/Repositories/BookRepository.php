<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepository
{
    public const PAGE_SIZE = 10;

    public function filterBy(array $filters, int $limit = self::PAGE_SIZE): LengthAwarePaginator;
}
