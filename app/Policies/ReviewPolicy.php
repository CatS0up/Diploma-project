<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return !$user->hasReview();
    }

    public function delete(User $user, Review $reviews)
    {
        return $user->id === $reviews->user_id || $user->isAdmin();
    }
}
