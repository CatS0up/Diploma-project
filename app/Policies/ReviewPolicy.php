<?php

namespace App\Policies;

use App\Models\Reviews;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return !$user->hasReview();
    }

    // public function delete(User $user, Reviews $reviews)
    // {
    //     //
    // }
}
