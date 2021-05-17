<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Pagination\Paginator;

interface Pageable
{
    public const LIMIT = 15;

    public function allPaginated(int $limit = self::LIMIT);
}
