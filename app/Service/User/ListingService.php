<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Collection;

class ListingService
{
    private User $userModel;
    private StatsService $stats;

    public function __construct(User $userModel, StatsService $stats)
    {
        $this->userModel = $userModel;
        $this->stats = $stats;
    }

    public function stats(): array
    {
        return $this->stats->countStats();
    }


    public function latest(int $limit = 5): Collection
    {
        return $this->userModel
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
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
