<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Collection;

interface GenreRepository
{
    public function all(): Collection;
}
