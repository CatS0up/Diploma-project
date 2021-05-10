<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface GenreRepository
{
    public function all(): Collection;
    public function allPaginated(int $limit = 15): Paginator;
}
