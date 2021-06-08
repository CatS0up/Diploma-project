<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return !$user->has('review');
    }

    public function delete(User $user, Review $model)
    {
        return $user->isAdmin() || $user->id === $model->user_id;
    }
}
