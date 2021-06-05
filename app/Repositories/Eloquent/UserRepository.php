<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepository as UserRepositoryInterface;
use App\Services\User\UserFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    private User $user;
    private UserFilter $filter;

    public function __construct(User $user, UserFilter $filter)
    {
        $this->user = $user;
        $this->filter = $filter;
    }

    public function findById(int $id): User
    {
        return $this->user->find($id);
    }

    public function latest(int $limit): ?Collection
    {
        return $this->user->latest()->take($limit)->get();
    }

    public function allPrivilaged(): ?Collection
    {
        return $this->user->privilaged()->get();
    }

    public function filterBy(array $filters, int $limit = self::PAGE_SIZE): LengthAwarePaginator
    {
        if (isset($filters['q']))
            $this->filter->setPhrase($filters['q']);


        return $this->filter->getPaginated($limit);
    }
}
