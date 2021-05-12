<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function create(array $data): User;
    public function get(int $id): ?User;
    public function delete(int $id): bool;
    public function update(array $data);
    public function all(): ?Collection;
    public function allPrivilaged(): Collection;
    public function allNormal(): ?Collection;
    public function allPaginated(int $limit): Paginator;
    public function stats(): array;
}
