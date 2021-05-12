<?php

declare(strict_types=1);

namespace App\Repository;

interface BookRepository
{
    public function create(array $data): void;
}
