<?php

declare(strict_types=1);

namespace App\Repository;

interface Maintable
{
    public function create(array $data);
    public function get(int $id);
    public function update(array $data);
    public function delete(int $id): bool;
}
