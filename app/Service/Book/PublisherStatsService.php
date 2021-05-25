<?php

declare(strict_types=1);

namespace App\Service\Book;

use App\Models\Publisher;

class PublisherStatsService
{
    private Publisher $publisherModel;

    public function __construct(Publisher $publisherModel)
    {
        $this->publisherModel = $publisherModel;
    }

    public function countStats(): array
    {
        return [
            'all_amount' => $this->allCount()
        ];
    }

    public function allCount(): int
    {
        return $this->publisherModel->count();
    }
}
