<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Collection;

class ListingService
{
    private User $userModel;
    private ListingStatsService $stats;

    public function __construct(User $userModel, ListingStatsService $stats)
    {
        $this->userModel = $userModel;
        $this->stats = $stats;
    }

    public function stats(): array
    {
        return $this->stats->countStats();
    }

    public function allPrivilaged(): Collection
    {
        return $this->userModel->Privilaged()->get();
    }

    public function filterBy(array $filters, int $limit = 15)
    {
        $query = $this->userModel
            ->with('personalDetails')
            ->normal();


        if ($filters['q']) {
            $phrase = "{$filters['q']}%";

            $query->where('uid', 'like', $phrase)
                ->orWhere('email', 'like', $phrase);
        }

        return $query->paginate($limit);
    }
}
