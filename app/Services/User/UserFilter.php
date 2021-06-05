<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFilter
{
    private User $query;

    public function __construct(User $query)
    {
        $this->query = $query;
    }

    public function setPhrase(string $phrase): UserFilter
    {
        $phrase = "$phrase%";

        $this->query
            ->where('uid', 'like', $phrase)
            ->orWhere('email', 'like', $phrase)
            ->orWhere('firstname', 'like', $phrase)
            ->orWhere('lastname', 'like', $phrase);

        return $this;
    }

    public function setSort(string $by, string $direction = 'asc'): UserFilter
    {
        $this->query->orderBy($by, $direction);

        return $this;
    }

    public function getPaginated(int $limit = 10): LengthAwarePaginator
    {
        return $this->query->paginate($limit);
    }
}
