<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepository as UserRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function get(int $id): User
    {
        return $this->userModel->find($id);
    }

    public function all(): ?Collection
    {
        return $this->userModel->get() ?? [];
    }

    public function allPrivilaged(): Collection
    {
        return $this->userModel
            ->privilaged()
            ->get();
    }

    public function allNormal(): ?Collection
    {
        return $this->userModel
            ->normal()
            ->get() ?? [];
    }

    public function allPaginated(int $limit): Paginator
    {
        return $this->userModel->paginate($limit);
    }
}
