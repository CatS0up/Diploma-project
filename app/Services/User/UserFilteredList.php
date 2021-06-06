<?php

declare(strict_types=1);

use App\Services\Listing\FilteredList;
use App\Services\User\UserFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFilteredList extends FilteredList
{
    private const ACCEPTABLE_FILTERS = ['q', 'sort', 'sort_by'];
    private const DEFAULT_FILTERS = [
        'sort' => 'asc',
        'sort_by' => 'id',
    ];

    private UserFilter $filter;

    public function __construct(UserFilter $filter)
    {
        $this->acceptableFilters = self::ACCEPTABLE_FILTERS;
        $this->defaultFiletrs = self::DEFAULT_FILTERS;

        $this->filter = $filter;
    }

    public function filter(): LengthAwarePaginator
    {
        $this->prepareFilters();

        if (isset($this->filters['q']))
            $this->filter->setPhrase($this->filters['q']);

        if ($this->filters['genre'] = $this->filters['genre'] ?? null)
            $this->filter->setSort($this->filters['sort'], $this->filters['sort_by']);



        return $this->filter->getPaginated();
    }
}
