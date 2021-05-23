<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BookListing
{
    public const RELATIONS =  ['genres', 'authors', 'publisher'];
    public const TYPE_ALL = 'all';
    public const SORT_DEFAULT = 'asc';


    public function filterBy(array $filters, int $limit): LengthAwarePaginator;
}
