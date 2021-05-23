<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\User;

class ListingStatsService
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function countStats(): array
    {
        return [
            'all_amount' => $this->userModel->count(),
            'privilaged_amount' => $this->userModel->privilaged()->count()
        ];
    }
}
