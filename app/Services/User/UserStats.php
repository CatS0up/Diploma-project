<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;

class UserStats
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function count(): int
    {
        return $this->user->count();
    }

    public function privilagedCount(): int
    {
        return $this->user->privilaged()->count();
    }
}
