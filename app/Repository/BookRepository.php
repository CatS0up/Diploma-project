<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Book;
use Illuminate\Support\Collection;

interface BookRepository
{
    public function create(array $data): Book;
    public function get(int $id): ?Book;
    public function delete(int $id): bool;
    public function update(array $data);
    public function all(): Collection;
}
