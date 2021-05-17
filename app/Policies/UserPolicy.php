<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\user;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, user $model)
    {
        return $user->id === $model->id;
    }
}
