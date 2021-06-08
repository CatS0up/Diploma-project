<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, User $model)
    {
        if ($model->isAdmin())
            return $user->isSuperadmin() || $user->id === $model->id;

        return $user->isAdmin() || $user->id === $model->id;
    }

    public function update(User $user, User $model)
    {
        if ($model->isAdmin())
            return $user->isSuperadmin() || $user->id === $model->id;

        return $user->isAdmin() || $user->id === $model->id;
    }

    public function updateByUser(User $user, User $model)
    {
        return $user->id === $model->id;
    }
}
