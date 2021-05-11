<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function get(int $id): User;
    public function all(): ?Collection;
    public function allPrivilaged(): Collection;
    public function allNormal(): ?Collection;
    public function allPaginated(int $limit): Paginator;
}
