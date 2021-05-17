<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface GenreRepository
{
    public function all(): Collection;
    public function create(string $name): void;
    public function delete(int $id): void;
}
