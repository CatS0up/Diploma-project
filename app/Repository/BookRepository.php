<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Support\Collection;

interface BookRepository
{
    public const PUBLISHER_ALL = 'all';
    public const PUBLISHER_DEFAULT = 'Pearson';

    public const GENRE_ALL = 'all';
    public const GENRE_DEFAULT = 'Fantasy';

    public const SORT_DEFAULT = 'asc';

    public function all(): Collection;
}
