<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFilter
{
    private User $user;
    private Builder $query;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->query = $this->user->with(['role', 'personalDetails', 'books']);
    }

    public function setPhrase(string $phrase): UserFilter
    {
        $phrase = "$phrase%";

        $this->query
            ->where('uid', 'like', $phrase)
            ->orWhere('email', 'like', $phrase);

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
