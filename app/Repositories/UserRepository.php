<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepository
{
    public const PAGE_SIZE = 10;

    public function findById(int $id): User;
    public function latest(int $limit): ?Collection;
    public function allPrivilaged(): ?Collection;
    public function filterBy(array $filters, int $limit = self::PAGE_SIZE): LengthAwarePaginator;
}
