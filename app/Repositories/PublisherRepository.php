<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Collection;

interface PublisherRepository
{
    public function all(): Collection;
}
