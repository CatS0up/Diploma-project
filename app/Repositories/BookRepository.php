<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookRepository
{
    public const PAGE_SIZE = 10;
    public const TYPE_DEFAULT = 'all';
    public const SORT_DEFAULT = 'asc';

    public function latest(int $limit): ?Collection;
    public function filterBy(array $filters, int $limit = self::PAGE_SIZE): LengthAwarePaginator;
}
