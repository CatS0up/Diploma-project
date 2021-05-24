<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\User;

class StatsService
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function countStats(): array
    {
        return [
            'all_amount' => $this->allCount(),
            'privilaged_amount' => $this->privilagedCount()
        ];
    }

    public function allCount(): int
    {
        return $this->userModel->count();
    }

    public function privilagedCount(): int
    {
        return $this->userModel->privilaged()->count();
    }
}
