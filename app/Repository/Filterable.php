<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Pageable;

interface Filterable extends Pageable
{
    public const SORT_DEFAULT = 'asc';

    public function filterBy(array $filters, int $limit = self::LIMIT);
}
