<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Pageable;
use Illuminate\Pagination\Paginator;

interface Filterable extends Pageable
{
    public function filterBy(array $filters, int $limit = self::LIMIT);
}
